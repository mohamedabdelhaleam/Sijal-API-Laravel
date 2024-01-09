<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = ['total_amount', 'status', 'order_date', 'user_id'];
    protected $hidden = [];
    public $timestamps = true;


    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class, "order_id", "id");
    }}
