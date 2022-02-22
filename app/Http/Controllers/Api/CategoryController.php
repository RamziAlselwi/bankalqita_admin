<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * get Emirate List
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $categories = Category::with('products')->orderBy('id','Asc')->get();

        return $this->successResponse($categories);
    }

}
