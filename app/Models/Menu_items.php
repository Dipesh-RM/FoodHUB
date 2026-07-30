<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_items extends Model
{
   public function category(){
    return $this->belongsTo(Category::class);
   }
   public function vendors(){
    return $this->belongsTo(Vendors::class);
   }
   public function charts(){
    return $this->hasMany(Chart::class);
   }
   public function reviews(){
    return $this->hasMany(Review::class);
   }
   public function orderitems(){
    return $this->hasMany(OrderItem::class);
   }
}
