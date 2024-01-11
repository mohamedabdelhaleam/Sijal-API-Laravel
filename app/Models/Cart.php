<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "carts";
    protected $fillable = ['user_id'];
    protected $hidden = [];
    public $timestamps = false;



    public function CartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
