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

    public function getProvinces()
    {
        return response()->json($this->shippingService->getProvinces());
    }

    public function getCities(Request $request)
    {
        $provinceId = $request->input('province_id');
        return response()->json($this->shippingService->getCities($provinceId));
    }
}
