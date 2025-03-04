<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Address extends Model
{
    protected $primaryKey = 'address_id';
    protected $fillable = ['user_id', 'street', 'city', 'state', 'country', 'postal_code', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }
    public function shippingOrders()
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }
    public function billingOrders()
    {
        return $this->hasMany(Order::class, 'billing_address_id');
    }
    public $timestamps = false;
}
