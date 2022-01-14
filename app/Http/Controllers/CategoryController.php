<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Show Category List
     *
     * @param Request $request
     * @return mixed
     */
    public function getCategorList(Request $request)
    {
        $data = Category::get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $output = '';
                if ($data->name == 'Super Admin') {
                    return '';
                }
                $output = '<div class="table-actions">
                            <a href="' . url('categories/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                            <a href="' . url('categories/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                        </div>';

                return $output;
            })
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
        return view('categories.create');
        
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
            // store category information
            $category = Category::create([
                'name' => $request->name,
            ]);


            if ($category) {
                return redirect('categories')->with('success', 'تم إنشاء فئة جديدة!');
            }
            
            return redirect('categories/create')->with('error', 'فشل إنشاء فئة جديد! حاول مجددا.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::find($id);

            if ($category) {
                return view('categories.edit', compact('category'));
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // update category info
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required | string ',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            if ($category = Category::find($request->id)) {
                $payload = [
                    'name' => $request->name,
                ];


                $update = $category->update($payload);

                return redirect('categories')->with('success', 'تم تحديث الفئة بنجاح!');
            }

            return redirect()->back()->with('error', 'فشل تحديث الفئة! حاول مجددا.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($category = Category::find($id)) {
            $category->delete();

            return redirect('categories')->with('success', 'تم حذف الفئة بنجاح');
        }

        return redirect('categories')->with('error', 'الفئة غير موجودة');
    }
}
