<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = ['name', 'description', 'image', 'created_at', 'updated_at'];
    protected $hidden = [];
    public $timestamps = true;


    public function Products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
