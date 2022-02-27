<?php

namespace App\Http\Controllers\Api;
use App\Models\Setting;
use App\Models\Emirate;
use App\Models\City;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
     * get Setting List
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $warranty_terms = Setting::select('value')->where('key', 'warranty_terms')->first();
        $instructions_for_user = Setting::select('value')->where('key', 'instructions_for_user')->first();
        $emirates = Emirate::with('cities')->get();

        return $this->successResponse([
            'warranty_terms' => $warranty_terms,
            'instructions_for_user' => $instructions_for_user,
            'emirates' => $emirates
        ]);
    }


    /**
     * get  WarrantyTerms
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function warrantyTerms(): JsonResponse
    {
        $warranty_terms = Setting::select('value')->where('key', 'warranty_terms')->first();
        return $this->successResponse($warranty_terms);
    }

    /**
     * get  instructions
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function instructions(): JsonResponse
    {
        $instructions_for_user = Setting::select('value')->where('key', 'warranty_terms')->first();
        return $this->successResponse($instructions_for_user);
    }

    /**
     * get  instructions
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function companies(): JsonResponse
    {
        $companies = Setting::select('value')->where('key', 'companies')->first();
        if($companies){
            $companies =  $companies->value;
        }
        
        return $this->successResponse($companies);
    }

    /**
     * get  terms_conditions
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function termsConditions(): JsonResponse
    {
        $terms_conditions = Setting::select('value')->where('key', 'terms_conditions')->first();
        if($terms_conditions){
            $terms_conditions =  $terms_conditions->value;
        }
        
        return $this->successResponse($terms_conditions);
    }

}
