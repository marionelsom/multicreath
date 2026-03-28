<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Project;
use App\Models\Invoice;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'      => Order::count(),
            'orders_today'      => Order::whereDate('created_at', today())->count(),
            'total_customers'   => Customer::where('active', true)->count(),
            'total_products'    => Product::where('active', true)->count(),
            'active_projects'   => Project::whereIn('status', ['propuesta', 'en_proceso'])->count(),
            'revenue_month'     => Order::whereMonth('created_at', now()->month)
                                        ->where('payment_status', 'pagado')
                                        ->sum('total'),
            'pending_orders'    => Order::where('status', 'pendiente')->count(),
            'low_stock_count'   => ProductVariant::whereColumn('stock', '<=', 'min_stock')->count(),
        ];

        $recent_orders = Order::with('customer')
            ->latest()
            ->take(6)
            ->get();

        $low_stock = ProductVariant::with('product')
            ->whereColumn('stock', '<=', 'min_stock')
            ->orderBy('stock')
            ->take(5)
            ->get();

        $active_projects = Project::with('customer')
            ->whereIn('status', ['propuesta', 'en_proceso'])
            ->latest()
            ->take(5)
            ->get();

        // Revenue for last 7 days chart
        $revenue_chart = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $revenue_chart[] = [
                'date'    => $date->format('d/m'),
                'revenue' => Order::whereDate('created_at', $date)->where('payment_status', 'pagado')->sum('total'),
                'orders'  => Order::whereDate('created_at', $date)->count(),
            ];
        }

        return view('admin.dashboard.index', compact(
            'stats', 'recent_orders', 'low_stock', 'active_projects', 'revenue_chart'
        ));
    }
}
