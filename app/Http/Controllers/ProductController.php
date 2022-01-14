<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }


    /**
     * Show Product List
     *
     * @param Request $request
     * @return mixed
     */
    public function getProductList(Request $request)
    {
        $data = Product::with('category')->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $output = '';
                if ($data->name == 'Super Admin') {
                    return '';
                }
                $output = '<div class="table-actions">
                            <a href="' . route('products.edit', $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                            <a href="' . route('products.destroy', $data->id) . 'data-method="delete" "><i class="ik ik-trash-2 f-16 text-red"></i></a>
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
        try {
            $categories = Category::pluck('name', 'id');

            return view('products.create', compact('categories'));
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
            // store product information
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
            ]);


            if ($product) {
                return redirect('products')->with('success', 'تم إنشاء المنتج جديدة!');
            }
            
            return redirect(route('products.create'))->with('error', 'فشل إنشاء المنتج جديد! حاول مجددا.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'هذا المنتج ليس موجود');
            }
            
            $categories = Category::pluck('name', 'id');

            return view('products.edit', compact('product', 'categories'));

        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // update product info
        $validator = Validator::make($request->all(), [
            'name' => 'required | string ',
            'price' => 'required | integer ',
            'category_id' => 'required | integer ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            if ($product = Product::find($product->id)) {
                $payload = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'category_id' => $request->category_id,
                ];


                $update = $product->update($payload);

                return redirect('products')->with('success', 'تم تحديث المنتج بنجاح!');
            }

            return redirect()->back()->with('error', 'فشل تحديث المنتج! حاول مجددا.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($product = Product::find($id)) {
            $product->delete();

            return redirect('products')->with('success', 'تم حذف الفئة بنجاح');
        }

        return redirect('products')->with('error', 'الفئة غير موجودة');
    }

    
}
