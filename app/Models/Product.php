<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['name', 'description', 'price', 'stock_quantity', 'image', 'category_id', 'created_at', 'updated_at'];
    protected $hidden = [];
    public $timestamps = true;


    public function Categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
}
