<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'vendor_id',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function vendors()
    {
        return $this->belongsTo(Vendors::class, 'vendor_id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class,'shipping_address_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * ============================================
     * FIXED: Get only items for THIS specific order
     * ============================================
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function canCancel()
    {
        return in_array($this->status, ['pending', 'confirmed', 'preparing']);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-700',
            'confirmed' => 'bg-blue-100 text-blue-700',
            'preparing' => 'bg-orange-100 text-orange-700',
            'ready' => 'bg-purple-100 text-purple-700',
            'delivered' => 'bg-green-100 text-green-700',
            'completed' => 'bg-green-100 text-green-700',
            'cancelled' => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }

    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }

    public function getPaymentStatusBadgeAttribute()
    {
        return match($this->payment_status) {
            'paid' => 'bg-green-100 text-green-700',
            'pending' => 'bg-yellow-100 text-yellow-700',
            'failed' => 'bg-red-100 text-red-700',
            'refunded' => 'bg-blue-100 text-blue-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
}
