<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Review;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = ['name', 'description', 'price', 'stock_quantity', 'category_id', 'seller_id','image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }

    public function getRecentReviewsAttribute()
    {
        return $this->reviews()->orderBy('created_at', 'desc')->take(5)->get();
    }

    public function getTotalSoldAttribute()
    {
        return $this->orderItems()->sum('quantity');
    }

    public function getTotalRevenueAttribute()
    {
        return $this->orderItems()->sum('quantity') * $this->price;
    }

}
