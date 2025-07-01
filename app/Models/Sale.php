<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number', 'cashier_id', 'subtotal', 'tax', 'discount',
        'total', 'payment_method', 'status', 'sale_date'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'sale_date' => 'datetime',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($sale) {
            if (empty($sale->invoice_number)) {
                $sale->invoice_number = static::generateInvoiceNumber($sale->sale_date ?? now());
            }
        });
    }

    public static function generateInvoiceNumber($date = null)
    {
        $date = $date ?? now();
        $dateString = $date->format('Ymd');
        
        // Get the count of sales for this specific date (including time)
        $count = static::whereDate('sale_date', $date->toDateString())->count();
        
        // Increment for next invoice
        $nextNumber = $count + 1;
        
        // Generate invoice number with milliseconds to ensure uniqueness
        $timestamp = $date->format('His'); // Hour, minute, second
        $microseconds = substr($date->format('u'), 0, 3); // First 3 digits of microseconds
        
        return "INV-{$dateString}-{$timestamp}{$microseconds}-" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
