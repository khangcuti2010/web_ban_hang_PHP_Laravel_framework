<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts_Detail extends Model
{
    use HasFactory;
    protected $table = 'carts_detail';
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
    ];
    //mối quan hệ với model Menu
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
