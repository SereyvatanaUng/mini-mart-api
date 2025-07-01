<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    public function run()
    {
        $cashiers = User::where('role', 'cashier')->get();
        $products = Product::where('is_active', true)->get();

        if ($cashiers->isEmpty() || $products->isEmpty()) {
            echo "❌ No cashiers or products found. Skipping sales seeding.\n";
            return;
        }

        echo "🔄 Creating sample sales data...\n";

        // Create sales for the last 7 days
        for ($day = 6; $day >= 0; $day--) {
            $date = Carbon::today()->subDays($day);
            $salesCount = rand(5, 15); // 5-15 sales per day

            echo "📅 Creating {$salesCount} sales for {$date->format('Y-m-d')}\n";

            for ($i = 0; $i < $salesCount; $i++) {
                $this->createSingleSale($cashiers, $products, $date, $i + 1);
            }

            echo "✅ Completed sales for {$date->format('Y-m-d')}\n";
        }

        echo "\n🎉 Sales seeding completed successfully!\n";
    }

    private function createSingleSale($cashiers, $products, $date, $saleNumber)
    {
        try {
            DB::beginTransaction();

            $cashier = $cashiers->random();
            $saleProducts = $products->random(rand(1, 4)); // 1-4 items per sale
            
            $subtotal = 0;
            $saleItems = [];

            // Calculate sale items
            foreach ($saleProducts as $product) {
                $quantity = rand(1, 3);
                $totalPrice = $product->price * $quantity;
                $subtotal += $totalPrice;

                $saleItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'total_price' => $totalPrice,
                ];
            }

            $tax = round($subtotal * 0.08, 2); // 8% tax
            $discount = rand(0, 3) == 0 ? round($subtotal * 0.05, 2) : 0; // 25% chance of 5% discount
            $total = $subtotal + $tax - $discount;

            // Create unique sale date/time for this sale
            $saleDateTime = $date->copy()
                ->addHours(rand(8, 20))
                ->addMinutes(rand(0, 59))
                ->addSeconds(rand(0, 59))
                ->addMicroseconds(rand(0, 999999));

            // Create the sale
            $sale = Sale::create([
                'cashier_id' => $cashier->id,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'payment_method' => collect(['cash', 'card', 'digital_wallet'])->random(),
                'sale_date' => $saleDateTime,
                'status' => 'completed',
                'created_at' => $saleDateTime,
                'updated_at' => $saleDateTime,
            ]);

            // Create sale items
            foreach ($saleItems as $itemData) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $itemData['product_id'],
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'total_price' => $itemData['total_price'],
                    'created_at' => $saleDateTime,
                    'updated_at' => $saleDateTime,
                ]);
            }

            DB::commit();

            // Progress indicator
            if ($saleNumber % 5 == 0) {
                echo "  📝 Created {$saleNumber} sales...\n";
            }

        } catch (\Exception $e) {
            DB::rollBack();
            echo "❌ Error creating sale {$saleNumber}: " . $e->getMessage() . "\n";
        }
    }
}
