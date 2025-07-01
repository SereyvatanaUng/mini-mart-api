<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Shop Owner
        $shopOwner = User::create([
            'name' => 'John Smith',
            'email' => 'owner@minimart.com',
            'password' => Hash::make('password123'),
            'role' => 'shop_owner',
            'phone' => '+1-555-0101',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        echo "✅ Shop Owner created: {$shopOwner->email}\n";

        // Create Cashier 1
        $cashier1 = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sereyvatanaung@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'cashier',
            'phone' => '+1-555-0102',
            'shop_owner_id' => $shopOwner->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        echo "✅ Cashier 1 created: {$cashier1->email}\n";

        // Create Cashier 2
        $cashier2 = User::create([
            'name' => 'Mike Wilson',
            'email' => 'mike@minimart.com',
            'password' => Hash::make('password123'),
            'role' => 'cashier',
            'phone' => '+1-555-0103',
            'shop_owner_id' => $shopOwner->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        echo "✅ Cashier 2 created: {$cashier2->email}\n";

        echo "\n📧 Login Credentials:\n";
        echo "Shop Owner: owner@minimart.com / password123\n";
        echo "Cashier 1:  sarah@minimart.com / password123\n";
        echo "Cashier 2:  mike@minimart.com / password123\n\n";
    }
}