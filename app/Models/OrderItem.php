<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $fillable = ['quantity', 'sub_total', 'order_id', 'product_id'];
    protected $hidden = [];
    public $timestamps = false;
}
