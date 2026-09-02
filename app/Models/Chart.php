<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    public function menu_items(){
        return $this->belongsTo(MenuItems::class);
    }
     public function vendors(){
        return $this->belongsTo(Vendors::class);
    }
}
