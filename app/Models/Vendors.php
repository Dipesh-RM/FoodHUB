<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendors extends Model
{
    public function menu_items(){
        return $this->hasMany(Menu_items::class);
    }
    public function chart(){
        return $this->hasMany(Chart::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
    public function orderitem(){
        return $this->hasMany(OrderItem::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

}
