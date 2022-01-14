<?php

namespace App\Http\Controllers\Api;
use App\Models\Emirate;
use App\Models\City;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmirateController extends BaseController
{
    /**
     * get Emirate List
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $emirates = Emirate::with('cities')->get();

        return $this->successResponse($emirates);
    }

}
