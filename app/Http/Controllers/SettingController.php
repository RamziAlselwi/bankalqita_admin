<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warranty_terms = Setting::select('value')->where('key', 'warranty_terms')->first();
        $instructions_for_user = Setting::select('value')->where('key', 'instructions_for_user')->first();
        $companies = Setting::select('value')->where('key', 'companies')->first();
        if($warranty_terms){
            $warranty_terms = $warranty_terms->value;
        } 
        if($instructions_for_user){
            $instructions_for_user =  $instructions_for_user->value;
        }

        if($companies){
            $companies =  $companies->value;
        }


        return view('settings.globals', compact('warranty_terms', 'instructions_for_user', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->except(['_method', '_token']);

        if(isset($input['warranty_terms'])){
            $settings = Setting::where('key', 'warranty_terms')->first();

            if($settings){
                $settings->update(['value' => $input['warranty_terms']]);
            } else {
                $settings = Setting::create([
                    'key' => 'warranty_terms',
                    'value' => $input['warranty_terms'],
                  ]);
            }
        }

        if(isset($input['instructions_for_user'])){
            $settings = Setting::where('key', 'instructions_for_user')->first();
            
            if($settings){
                $settings->update(['value' => $input['instructions_for_user']]);
            } else {
                $settings = Setting::create([
                    'key' => 'instructions_for_user',
                    'value' => $input['instructions_for_user'],
                  ]);
            }
        }

        if(isset($input['companies'])){
            $settings = Setting::where('key', 'companies')->first();
            
            if($settings){
                $settings->update(['value' => $input['companies']]);
            } else {
                $settings = Setting::create([
                    'key' => 'companies',
                    'value' => $input['companies'],
                  ]);
            }
        }

        return redirect()->back()->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
