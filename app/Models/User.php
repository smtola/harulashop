<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'email', 'password_hash', 'first_name', 'last_name', 'role'];
    protected $hidden = ['password_hash'];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function isSeller()
    {
        return $this->role === 'seller';
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }
}