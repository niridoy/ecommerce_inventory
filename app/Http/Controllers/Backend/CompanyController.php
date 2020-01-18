<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductStockSend;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:company']);
    }

    public function index()
    {
        $data['ProductStockReceivedList'] = ProductStockSend::all();
        return view('backend.company.index',$data);
    }

    public function receivedProduct($id)
    {
        $Product = ProductStockSend::findOrFail($id);
        $Product->update(['is_received' => 1]);
        return redirect()->back()->withSuccess('Product Received Successfully!');
    }
}
