<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShippingService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function __invoke(Request $request)
    {
        $destination = $request->input('destination');
        $weight = 1000; // Default 1kg for now
        $courier = $request->input('courier');

        return response()->json($this->shippingService->getCost($destination, $weight, $courier));
    }
}
