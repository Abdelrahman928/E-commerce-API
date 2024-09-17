<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id', 'role', 'phone_verified_at', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->cart()->create(); 
        });
    }
    

    public function markMobileAsVerified()
    {
        $this->phone_verified_at = now();
        $this->save();
    }

    public function markEmailAsVerified()
    {
        $this->email_verified_at = now();
        $this->save();
    }

    public function routeNotificationForVonage(Notification $notification): string
    {
        return $this->phone_number;
    }

    public function shippingAddress(){
        return $this->hasMany(ShippingAddress::class);
    }

    public function userPayment(){
        return $this->hasMany(UserPaymentMethod::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function UserPaymentMethod(){
        return $this->hasMany(UserPaymentMethod::class);
    }
}
