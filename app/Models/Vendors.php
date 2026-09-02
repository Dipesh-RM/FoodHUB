<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendors extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'must_change_password',
    'city',
    'address',
    'latitude',
    'longitude',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
 'password' => 'hashed',
        'must_change_password' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',

        ];
    }
      public function menuItems(){
        return $this->hasMany(MenuItems::class,'vendor_id');
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
    public function categories()
{
    return $this->hasMany(Category::class, 'vendor_id');
}

}
