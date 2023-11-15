<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }
}
