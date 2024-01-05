<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = "reviews";
    protected $fillable = ['comment', 'date_posted', 'user_id', 'product_id'];
    protected $hidden = [];
    public $timestamps = true;
}
