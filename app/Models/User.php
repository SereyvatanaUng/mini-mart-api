<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'shop_owner_id', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function cashiers()
    {
        return $this->hasMany(User::class, 'shop_owner_id');
    }

    public function shopOwner()
    {
        return $this->belongsTo(User::class, 'shop_owner_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'cashier_id');
    }

    // Scopes
    public function scopeShopOwners($query)
    {
        return $query->where('role', 'shop_owner');
    }

    public function scopeCashiers($query)
    {
        return $query->where('role', 'cashier');
    }

    public function scopeUsers($query)
    {
        return $query->where('role', 'user');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helper methods
    public function isShopOwner()
    {
        return $this->role === 'shop_owner';
    }

    public function isCashier()
    {
        return $this->role === 'cashier';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function canManageProducts()
    {
        return $this->isShopOwner();
    }

    public function canMakeSales()
    {
        return $this->isShopOwner() || $this->isCashier();
    }
}
