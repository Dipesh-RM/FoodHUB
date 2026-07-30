<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    public function menu_items(){
        return $this->belongsTo(Menu_items::class);
    }
     public function vendors(){
        return $this->belongsTo(Vendors::class);
    }
}
