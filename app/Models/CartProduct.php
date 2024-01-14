<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = "cart_product";
    protected $fillable = ['cart_items_id', 'product_id'];
    protected $hidden = [];
    public $timestamps = false;
}
