<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $fillable = ['quantity', 'order_id', 'product_id'];
    protected $hidden = ['pivot'];
    public $timestamps = false;


    public function OrderItems()
    {
        return $this->belongsTo(Order::class, "order_id", "id");
    }
    public function Products()
    {
        return $this->belongsToMany(Product::class, "order_product", 'order_items_id', 'product_id');
    }
}
