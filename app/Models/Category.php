<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function vendors(){
        return $this->belongsTo(Vendors::class, 'vendor_id');
    }
    public function menuitems(){
        return $this->hasMany(MenuItems::class);
    }
}
