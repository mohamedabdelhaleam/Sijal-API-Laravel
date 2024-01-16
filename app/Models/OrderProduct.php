<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = "order_product";
    protected $fillable = ['order_items_id', 'product_id'];
    public $timestamps = false;
}
