<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function policy()
    {
        return view('refund.policy');
    }

    public function create()
    {
        return view('refund.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string|exists:orders,order_number',
            'customer_email' => 'required|email',
            'reason' => 'required|string|min:10',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
        ]);

        $order = \App\Models\Order::where('order_number', $validated['order_number'])
            ->where('customer_email', $validated['customer_email'])
            ->first();

        if (!$order) {
            return back()->withInput()->withErrors(['order_number' => 'Pesanan tidak ditemukan atau email tidak cocok.']);
        }

        if ($order->status !== \App\Enums\OrderStatus::Processing) {
            return back()->withInput()->withErrors(['order_number' => 'Refund hanya bisa diajukan untuk pesanan dengan status "Diproses".']);
        }

        // Check 24 hours constraint
        // Assuming updated_at reflects the time it became 'Processing' / Paid
        $paidTime = $order->updated_at;
        if (now()->diffInHours($paidTime) > 24) {
            return back()->withInput()->withErrors(['order_number' => 'Batas waktu pengajuan refund (1x24 jam dari waktu pembayaran) telah lewat.']);
        }

        if ($order->refund()->exists()) {
            return back()->withInput()->withErrors(['order_number' => 'Pesanan ini sudah pernah mengajukan refund sebelumnya.']);
        }

        $refund = \App\Models\Refund::create([
            'order_id' => $order->id,
            'reason' => $validated['reason'],
            'bank_name' => $validated['bank_name'],
            'account_number' => $validated['account_number'],
            'account_name' => $validated['account_name'],
            'status' => 'pending',
        ]);

        // Send email to admin
        try {
            $adminEmail = config('mail.admin_email', 'admin@example.com');
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\NewRefundRequestAdminMail($refund));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email refund ke admin: ' . $e->getMessage());
        }

        return redirect()->route('refund.policy')->with('success', 'Pengajuan refund berhasil dikirim. Tim kami akan segera meninjaunya.');
    }
}
