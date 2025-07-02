<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'barcode', 'description', 'price', 'cost_price',
        'stock_quantity', 'min_stock_level', 'image', 'image_url',
        'category_id', 'section_id', 'shelf_id', 'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected $appends = ['full_image_url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock_quantity', '<=', 'min_stock_level');
    }

    public function getLocationAttribute()
    {
        return $this->section->name . ' - ' . $this->shelf->name . ' (Level ' . $this->shelf->level . ')';
    }

    public function isLowStock()
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }

    // Get full image URL - prioritize image_url, fallback to uploaded image
    public function getFullImageUrlAttribute()
    {
        // If image_url is provided (external link), use it
        if (!empty($this->image_url)) {
            return $this->image_url;
        }
        
        // If uploaded image exists, return full URL
        if (!empty($this->image)) {
            return asset('storage/' . $this->image);
        }
        
        // Default placeholder image
        return asset('images/product-placeholder.png');
    }
}