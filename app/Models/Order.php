<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'shipment_status',
        'payment_status',
        'payment_proof',
        'shipping_address',
        'payment_method',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }
}
