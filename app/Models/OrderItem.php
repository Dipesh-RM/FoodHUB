<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function vendors(){
        return $this->belongsTo(Vendors::class);
    }
    public function menuitems(){
        return $this->belongsTo(User::class);
    }

}
