<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Product;

class ProductStockSend extends Model
{
    protected $table = 'product_stock_sends';

    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id')->withDefault();
    }
}
