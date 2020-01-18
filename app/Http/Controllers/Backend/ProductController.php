<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:supplier,company']);
    }

    public function index()
    {
        $data['ProductList'] = Product::All();
        return view('backend.product.index',$data);
    }

    public function create()
    {
        return view('backend.product.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|unique:products',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:1500',
            'status'   => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $Product = Product::Create(['name' => $request->name,'status' => $request->status]);

                $image = $request->file('image');

                if (isset($image))
                {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename = 'product_img_'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                    if (!Storage::disk('public')->exists('backend/images/product'))
                    {
                        Storage::disk('public')->makeDirectory('backend/images/product');
                    }

                    Storage::disk('public')->put('backend/images/product/'.$imagename,file_get_contents($image));

                    $Product->image = $imagename;
                    $Product->save();

                }

        return redirect()->back()->withSuccess('Product Added Successfully!');

    }

    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['Product'] = Product::findOrfail($id);
        return view('backend.product.edit',$data);
    }

    public function update(Request $request, $id)
    {
        //return $request;
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|unique:products,name,'.$id,
            'image'         => 'nullable|mimes:jpeg,png,jpg|max:1500',
            'status'        => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $Product = Product::findOrfail($id);

        $Product->update(['name'=> $request->name, 'status' => $request->status]);

        $image = $request->file('image');

                        if (isset($image))
                        {
                            $currentDate = Carbon::now()->toDateString();
                            $imagename = 'product_img_'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                            if (!Storage::disk('public')->exists('backend/images/product'))
                            {
                                Storage::disk('public')->makeDirectory('backend/images/product');
                            }

                            Storage::disk('public')->put('backend/images/product/'.$imagename,file_get_contents($image));

                            if(Storage::disk('public')->exists('backend/images/product/'. $Product->image)){
                                Storage::disk('public')->delete('backend/images/product/'. $Product->image);
                            }

                            $Product->image = $imagename ;
                            $Product->save();

                        }

        return redirect()->back()->withSuccess('Product Update Successfully!');
    }

    public function destroy($id)
    {
        $Product = Product::findOrFail($id);
        if(Storage::disk('public')->exists('backend/images/product/'.$Product->image)){
            Storage::disk('public')->delete('backend/images/product/'.$Product->image);
        }
        $Product->delete();

        return redirect()->back()->withSuccess('Product Deleted Successfully!');
    }
}
