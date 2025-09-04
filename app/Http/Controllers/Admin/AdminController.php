<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware moved to routes
    }

    public function dashboard()
    {
        // Get basic statistics
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        // Get monthly statistics (current month)
        $monthlyOrders = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Get top customers by total spent
        $topCustomers = User::select('users.*')
            ->selectRaw('COUNT(orders.id) as orders_count')
            ->selectRaw('COALESCE(SUM(orders.total), 0) as total_spent')
            ->leftJoin('orders', function($join) {
                $join->on('users.id', '=', 'orders.user_id')
                    ->where('orders.status', '=', 'completed');
            })
            ->groupBy('users.id')
            ->having('total_spent', '>', 0)
            ->orderBy('total_spent', 'desc')
            ->take(4)
            ->get();

        // Get recent orders with user relationship
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.pages.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'monthlyOrders',
            'monthlyRevenue',
            'topCustomers',
            'recentOrders'
        ));
    }
}
