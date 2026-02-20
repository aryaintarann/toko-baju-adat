<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        $refunds = Refund::with([
            'order' => function ($query) {
                $query->with('items');
            }
        ])->orderByRaw("
            CASE status
                WHEN 'pending' THEN 1
                WHEN 'approved' THEN 2
                WHEN 'rejected' THEN 3
                ELSE 4
            END
        ")
            ->latest()
            ->paginate(15);

        return view('admin.refunds.index', compact('refunds'));
    }

    public function process(Request $request, Refund $refund)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $refund->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        if ($request->status === 'approved') {
            $refund->order->update([
                'status' => OrderStatus::Refunded,
                'payment_status' => 'refunded'
            ]);
        }

        // Notify customer via email
        try {
            \Illuminate\Support\Facades\Mail::to($refund->order->customer_email)->send(new \App\Mail\RefundProcessedMail($refund));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email refund ke pelanggan: ' . $e->getMessage());
        }

        return back()->with('success', 'Status pengajuan refund berhasil diperbarui dan email notifikasi telah dikirim ke pelanggan.');
    }
}
