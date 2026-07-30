<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function vendors(){
        return $this->belongsTo(Vendors::class);
    }
    public function shippingAddress(){
        return $this->belongsTo(ShippingAddress::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
