<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'store_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'featured_image',
        'images',
        'is_active',
        'category_id',
        'installments_count',   // ✅ مضاف
        'low_stock_threshold',  // ✅ مضاف
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function getGalleryImagesAttribute()
    {
        return $this->images->pluck('image_path')->toArray();
    }
}