<?php

namespace App\Http\Controllers;

use App\Models\Emirate;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class EmirateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('emirates.index');
    }

    /**
     * Show Emirate List
     *
     * @param Request $request
     * @return mixed
     */
    public function getEmirateList(Request $request)
    {
        $data = Emirate::get();
        return Datatables::of($data)
            ->addColumn('action', 'emirates.datatables_actions')
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
        return view('emirates.create');
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
            // store emirate information
            $emirate = Emirate::create([
                'name' => $request->name,
            ]);


            if ($emirate) {
                return redirect('emirates')->with('success', 'تم إنشاء الاماره جديدة!');
            }
            
            return redirect('emirates/create')->with('error', 'فشل إنشاء الاماره جديد! حاول مجددا.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emirate  $emirate
     * @return \Illuminate\Http\Response
     */
    public function show(Emirate $emirate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emirate  $emirate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $emirate = Emirate::find($id);

            if ($emirate) {
                return view('emirates.edit', compact('emirate'));
            }

            return redirect('404');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emirate  $emirate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emirate $emirate)
    {
        // update emirate info
        $validator = Validator::make($request->all(), [
            'name' => 'required | string ',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            if ($emirate = Emirate::find($emirate->id)) {
                $payload = [
                    'name' => $request->name,
                ];


                $update = $emirate->update($payload);

                return redirect('emirates')->with('success', 'تم تحديث الاماره بنجاح!');
            }

            return redirect()->back()->with('error', 'فشل تحديث الاماره! حاول مجددا.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emirate  $emirate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($emirate = Emirate::find($id)) {
            $emirate->delete();

            return redirect('emirates')->with('success', 'تم حذف الاماره بنجاح');
        }

        return redirect('emirates')->with('error', 'الاماره غير موجودة');
    }
}
