<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function overview(Request $request)
    {
        $user = $request->user();
        
        // Base queries
        $todaySalesQuery = Sale::whereDate('sale_date', today());
        $productQuery = Product::where('is_active', true);
        
        // Filter by cashier if not shop owner
        if ($user->isCashier()) {
            $todaySalesQuery->where('cashier_id', $user->id);
        }

        $data = [
            'today_sales' => [
                'total_amount' => $todaySalesQuery->sum('total'),
                'total_transactions' => $todaySalesQuery->count(),
                'average_transaction' => $todaySalesQuery->count() > 0 
                    ? $todaySalesQuery->sum('total') / $todaySalesQuery->count() 
                    : 0,
            ],
            'products' => [
                'total_products' => $productQuery->count(),
                'low_stock_count' => $productQuery->whereColumn('stock_quantity', '<=', 'min_stock_level')->count(),
                'out_of_stock_count' => $productQuery->where('stock_quantity', 0)->count(),
            ]
        ];

        // Shop owner specific data
        if ($user->isShopOwner()) {
            $data['cashiers'] = [
                'total_cashiers' => User::cashiers()->where('shop_owner_id', $user->id)->count(),
                'active_cashiers' => User::cashiers()->where('shop_owner_id', $user->id)->where('is_active', true)->count(),
            ];
            
            $data['monthly_sales'] = Sale::whereMonth('sale_date', now()->month)
                ->whereYear('sale_date', now()->year)
                ->sum('total');
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function salesChart(Request $request)
    {
        $days = $request->get('days', 7); // Default last 7 days
        $user = $request->user();
        
        $salesData = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $query = Sale::whereDate('sale_date', $date);
            
            if ($user->isCashier()) {
                $query->where('cashier_id', $user->id);
            }
            
            $salesData[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->format('D'),
                'total_sales' => $query->sum('total'),
                'total_transactions' => $query->count(),
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $salesData
        ]);
    }

    public function topProducts(Request $request)
    {
        $limit = $request->get('limit', 10);
        $days = $request->get('days', 30);
        
        $startDate = Carbon::today()->subDays($days);
        
        $topProducts = Product::with('category')
            ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->where('sales.sale_date', '>=', $startDate)
            ->selectRaw('products.*, SUM(sale_items.quantity) as total_sold, SUM(sale_items.total_price) as total_revenue')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $topProducts
        ]);
    }
}