<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = "cart_items";
    protected $fillable = ['quantity', 'cart_id', 'product_id'];
    protected $hidden = ['pivot', 'product_id'];
    public $timestamps = false;


    public function Cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
    public function Products()
    {
        return $this->belongsToMany(Product::class, 'cart_product', 'cart_items_id', 'product_id');
    }
}
