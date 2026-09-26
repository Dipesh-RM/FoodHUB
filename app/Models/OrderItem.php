<?php
// app/Models/OrderItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',        // NEW
        'user_id',
        'vendor_id',
        'menu_item_id',
        'qty',
    ];

    protected $casts = [
        'qty' => 'integer',
    ];

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendors()
    {
        return $this->belongsTo(Vendors::class, 'vendor_id');
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItems::class, 'menu_item_id');
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function getNameAttribute()
    {
        return $this->menuItem->tittle ?? 'Unknown Item';
    }

    public function getPriceAttribute()
    {
        return $this->menuItem->price ?? 0;
    }

    public function getTotalAttribute()
    {
        return ($this->menuItem->price ?? 0) * $this->qty;
    }
}
