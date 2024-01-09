<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['name', 'description', 'price', 'stock_quantity', 'image', 'category_id', 'created_at', 'updated_at'];
    protected $hidden = ['pivot'];
    public $timestamps = true;


    public function Categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
    public function CartItems()
    {
        return $this->belongsToMany(CartItem::class, 'cart_product', 'product_id', 'cart_items_id');
    }
}
