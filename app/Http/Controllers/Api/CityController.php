<?php

namespace App\Http\Controllers\Api;
use App\Models\City;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends BaseController
{
    /**
     * get City List
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $input = $request->all();
        $cities = [];
        if($input['keyword'] && isset($input['keyword'])){
            $cities = City::where('name', 'like', $request->get('keyword') . '%')
            ->where('emirate_id', $input['emirate_id'])->take(5)->get();
        }
        return $this->successResponse($cities);
    }

}
