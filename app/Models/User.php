<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'shop_owner_id', 'is_active'
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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
}
