<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use Illuminate\Http\Request;
use App\Models\Backend\ProductStockSend;
use Carbon\Carbon;
use Validator;

class ProductStockSendController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:supplier']);
    }

    public function index()
    {

        $data['ProductStockSendList'] = ProductStockSend::All();
        return view('backend.product_stock_sent.index',$data);
    }

    public function create()
    {
        $data['ProductList'] = Product::whereStatus(1)->get();
        return view('backend.product_stock_sent.create',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date'          => 'required|date',
            'product_id'    => 'required|',
            'unit'          => 'required|numeric|min:1|max:10000000'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $date_formate = Carbon::parse($request->date)->format('Y-m-d');
        ProductStockSend::Create(['date' => $date_formate,'product_id' => $request->product_id,'unit' => $request->unit]);
        return redirect()->back()->withSuccess('Product Send Successfully!');

    }

    public function edit($id)
    {
        $data['ProductList'] = Product::whereStatus(1)->get();
        $data['ProductStockSend'] = ProductStockSend::findOrfail($id);
        return view('backend.product_stock_sent.edit',$data);
    }

    public function update(Request $request, $id)
    {
        //return $request;
        $validator = Validator::make($request->all(), [
            'date'          => 'required|date',
            'product_id'    => 'required|',
            'unit'          => 'required|numeric|min:1|max:10000000'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $ProductSend = ProductStockSend::findOrfail($id);
        $date_formate = Carbon::parse($request->date)->format('Y-m-d');
        $ProductSend->update(['date' => $date_formate,'product_id' => $request->product_id,'unit' => $request->unit]);

        return redirect()->back()->withSuccess('Product Send Record Update Successfully!');
    }

    public function destroy($id)
    {
        $ProductSend = ProductStockSend::findOrFail($id);
        $ProductSend->delete();

        return redirect()->back()->withSuccess('Product Send Record Deleted Successfully!');
    }
}
