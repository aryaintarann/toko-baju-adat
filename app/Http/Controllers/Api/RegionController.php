<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShippingService;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    protected $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function search(Request $request)
    {
        $query = $request->query('q');
        if (!$query) {
            return response()->json([]);
        }

        return response()->json($this->shippingService->searchDestination($query));
    }
}
