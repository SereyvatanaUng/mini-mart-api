<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['cashier', 'items.product']);

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('sale_date', [$request->start_date, $request->end_date]);
        }

        // Filter by today only
        if ($request->has('today') && $request->today) {
            $query->whereDate('sale_date', today());
        }

        // Filter by cashier (for shop owners)
        if ($request->has('cashier_id') && $request->user()->isShopOwner()) {
            $query->where('cashier_id', $request->cashier_id);
        }

        // If cashier, only show their sales
        if ($request->user()->isCashier()) {
            $query->where('cashier_id', $request->user()->id);
        }

        $sales = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $sales
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,card,digital_wallet',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
        ]);

        return DB::transaction(function () use ($request) {
            $subtotal = 0;
            $saleItems = [];

            // Calculate subtotal and prepare sale items
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                // Check if product is active
                if (!$product->is_active) {
                    throw new \Exception("Product '{$product->name}' is not available");
                }
                
                // Check stock availability
                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: {$product->name}. Available: {$product->stock_quantity}");
                }

                $totalPrice = $product->price * $item['quantity'];
                $subtotal += $totalPrice;

                $saleItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'total_price' => $totalPrice,
                ];
            }

            $tax = $request->tax ?? 0;
            $discount = $request->discount ?? 0;
            $total = $subtotal + $tax - $discount;

            // Create sale
            $sale = Sale::create([
                'cashier_id' => $request->user()->id,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'sale_date' => now(),
            ]);

            // Create sale items and update stock
            foreach ($saleItems as $saleItem) {
                $sale->items()->create([
                    'product_id' => $saleItem['product']->id,
                    'quantity' => $saleItem['quantity'],
                    'unit_price' => $saleItem['unit_price'],
                    'total_price' => $saleItem['total_price'],
                ]);

                // Update product stock
                $saleItem['product']->decrement('stock_quantity', $saleItem['quantity']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sale completed successfully',
                'data' => $sale->load(['items.product', 'cashier'])
            ], 201);
        });
    }

    public function show($id)
    {
        $sale = Sale::with(['cashier', 'items.product'])->findOrFail($id);

        // Check access permissions
        $user = request()->user();
        if ($user->isCashier() && $sale->cashier_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $sale
        ]);
    }

    public function dailySummary(Request $request)
    {
        $date = $request->get('date', today()->toDateString());
        
        $query = Sale::whereDate('sale_date', $date);
        
        // If cashier, only their sales
        if ($request->user()->isCashier()) {
            $query->where('cashier_id', $request->user()->id);
        }

        $summary = [
            'date' => $date,
            'total_sales' => $query->sum('total'),
            'total_transactions' => $query->count(),
            'cash_sales' => $query->where('payment_method', 'cash')->sum('total'),
            'card_sales' => $query->where('payment_method', 'card')->sum('total'),
            'digital_wallet_sales' => $query->where('payment_method', 'digital_wallet')->sum('total'),
            'average_transaction' => $query->count() > 0 ? $query->sum('total') / $query->count() : 0,
        ];

        return response()->json([
            'success' => true,
            'data' => $summary
        ]);
    }
}
