<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Emirate;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cities.index');
    }



    /**
     * Show City List
     *
     * @param Request $request
     * @return mixed
     */
    public function getCityList(Request $request)
    {
        $data = City::with('emirate')->get();
        return Datatables::of($data)
            ->addColumn('action', 'cities.datatables_actions')
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $emirates = Emirate::pluck('name', 'id');

            return view('cities.create', compact('emirates'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // store city information
            $city = City::create([
                'name' => $request->name,
                'emirate_id' => $request->emirate_id,
            ]);


            if ($city) {
                return redirect('cities')->with('success', 'تم إنشاء المدينه جديدة!');
            }
            
            return redirect(route('cities.create'))->with('error', 'فشل في إنشاء المدينه ! حاول مجددا.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $city = City::with('emirate')->find($id);

            if (!$city) {
                return redirect()->back()->with('error', 'هذا المدينه ليس موجود');
            }
            
            $emirates = Emirate::pluck('name', 'id');

            return view('cities.edit', compact('city', 'emirates'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        // update city info
        $validator = Validator::make($request->all(), [
            'name' => 'required | string ',
            'emirate_id' => 'required | integer ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            if ($city = City::find($city->id)) {
                $payload = [
                    'name' => $request->name,
                    'emirate_id' => $request->emirate_id,
                ];


                $update = $city->update($payload);

                return redirect('cities')->with('success', 'تم تحديث المدينه بنجاح!');
            }

            return redirect()->back()->with('error', 'فشل تحديث المدينه! حاول مجددا.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($city = City::find($id)) {
            $city->delete();

            return redirect('cities')->with('success', 'تم حذف المدينه بنجاح');
        }

        return redirect('cities')->with('error', 'المدينه غير موجودة');
    }

    /**
     * get cites badges by emirate
     *
     * @param Request $request
     * @return mixed
     */
    public function getCitesByEmirate(Request $request)
    {
        $badges = '';
        if ($request->id) {
            $emirate = Emirate::find($request->id);
            $cities = $emirate->cities()->pluck('name', 'id');
            return response()->json(['data' => $cities, 'success' => true], 200);

        }

        return $badges;
    }
}
