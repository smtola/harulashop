<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Payment extends Model
{
   protected $primaryKey = 'payment_id';
    protected $fillable = ['order_id', 'amount', 'payment_method', 'status', 'transaction_id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public $timestamps = false;
}
