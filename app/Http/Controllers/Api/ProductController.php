<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * get Emirate List
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $products = Product::all();

        return $this->successResponse($products);
    }

}
