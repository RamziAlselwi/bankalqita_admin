<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Emirate;
use App\Models\City;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.index');
    }


    /**
     * Show Store List
     *
     * @param Request $request
     * @return mixed
     */
    public function getStoreList(Request $request)
    {
        $data = Store::with('emirate')->with('city')->with('orders')->get();
        return Datatables::of($data)
            ->addColumn('image', function ($data) {
                if ($data->hasMedia('image')) {
                    return '<img src="'. $data->getFirstMediaUrl('image', 'thumb')  .'" class="table-user-thumb" alt="">';
                } else {
                    return '<img src="/img/download.png" class="table-user-thumb" alt="">';
                }
            })
            
            ->addColumn('commercial_register', function ($data) {
                if ($data->hasMedia('commercial_register')) {
                    return '<img src="'. $data->getFirstMediaUrl('commercial_register', 'thumb') .'" class="table-user-thumb" alt="">';
                } else {
                    return '<img src="/img/download.png" class="table-user-thumb" alt="">';
                }
            })
            ->addColumn('emirate', function ($data) {
                $emirate = $data->emirate;
                $badge = '';
                if ($emirate) {
                    $badge = $emirate->name;
                }

                return $badge;
            })
            ->addColumn('city', function ($data) {
                $city = $data->city;
                $badge = '';
                if ($city) {
                    $badge = $city->name;
                }

                return $badge;
            })
            ->addColumn('orders', function ($data) {
                return $data->orders->count();
            })
            ->addColumn('orders_amend', function ($data) {
                return $data->orders()->where('amended_at','!=', null)->get()->count();
            })

            
            ->addColumn('action', 'stores.datatables_actions')
            ->rawColumns(['image', 'commercial_register', 'emirate', 'city', 'orders', 'orders_amend', 'action'])
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
            $cities = City::pluck('name', 'id');

            return view('stores.create', compact('emirates', 'cities'));

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
        // create store info
        $validator = Validator::make($request->all(), [
            'name' => 'required | string ',
            'phone' => 'required|string|unique:stores,phone',
            'email' => 'required|string|unique:stores,email',
            'password' => 'required | string ',
            'emirate_id' => 'integer',
            'city_id' => 'integer',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            // create store information
            $store = Store::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'emirate_id' => $request->emirate_id,
                'city_id' => $request->city_id,
                'street' => $request->street,
                'email' => $request->email,
            ]);

            if (isset($request->image)) {
                $store->addMediaFromRequest('image')->toMediaCollection('image');
            }

            if (isset($request->commercial_register)) {
                $store->addMediaFromRequest('commercial_register')->toMediaCollection('commercial_register');
            }

            if ($store) {
                return redirect('stores')->with('success', '???? ?????????? ?????? ????????');
            }

            return redirect(route('stores.create'))->with('error', '?????? ???? ?????????? ?????????? ! ???????? ??????????.');

        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $store = Store::find($id);

        if (empty($store)) {
            return redirect(route('stores'))->with('error', '???? ???????? ?????? ????????????');
        }

        return view('stores.show')->with('store', $store);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $store = Store::with('emirate')->with('city')->find($id);

            if (!$store) {
                return redirect()->back()->with('error', '?????? ?????????? ?????? ??????????');
            }
            
            $emirates = Emirate::pluck('name', 'id');
            $cities = City::where('emirate_id', $store->emirate_id)->pluck('name', 'id');


            return view('stores.edit', compact('store', 'emirates', 'cities'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        // update store info
        $validator = Validator::make($request->all(), [
            'name' => 'required | string ',
            'phone' => 'required|string|unique:stores' . ',id,' . $store->id,
            'password' => 'required | string ',
            'emirate_id' => 'integer',
            'email' => 'required|string|unique:stores' . ',id,' . $store->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            if ($store = Store::find($store->id)) {
                $payload = [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'emirate_id' => $request->emirate_id,
                    'city_id' => $request->city_id,
                    'street' => $request->street,
                    'email' => $request->email,
                ];


                $update = $store->update($payload);

                if (isset($request->image)) {
                    $update->addMediaFromRequest('image')->toMediaCollection('image');
                }
    
                if (isset($request->commercial_register)) {
                    $update->addMediaFromRequest('commercial_register')->toMediaCollection('commercial_register');
                }
    

                return redirect('stores')->with('success', '???? ?????????? ?????????????? ??????????!');
            }

            return redirect()->back()->with('error', '?????? ?????????? ??????????????! ???????? ??????????.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($store = Store::find($id)) {
            $store->delete();

            return redirect('stores')->with('success', '???? ?????? ?????????? ??????????');
        }

        return redirect('stores')->with('error', '?????????? ?????? ????????????');
    }
}
