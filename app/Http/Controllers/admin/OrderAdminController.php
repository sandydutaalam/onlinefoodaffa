<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = UserOrder::orderBy('o_id', 'desc')->get();
        return view('admin.all_orders', compact('orders'));
    }

    public function viewOrder($o_id)
    {
        $orders = DB::table('users_orders')->where('o_id', $o_id)->get();

        if (!$orders) {
            abort(404); // Jika restoran tidak ditemukan, tampilkan 404
        }

        return view('admin.view_order', compact('orders'));
    }

    public function monthlyReport(Request $request)
    {
        // Validate that month and year are provided
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        $month = $request->input('month');
        $year = $request->input('year');

        // Filter orders based on selected month and year
        $orders = UserOrder::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        // Calculate the total revenue for the month
        $totalRevenue = $orders->sum('total_price');

        // Get best-selling products ordered by quantity
        $bestSellingProducts = UserOrder::select('title', DB::raw('SUM(quantity) as total_quantity'))
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy('title')
            ->orderByDesc('total_quantity')
            ->get();

        // Pass data to the view
        return view('admin.report', [
            'orders' => $orders,
            'totalRevenue' => $totalRevenue,
            'month' => $month,
            'year' => $year,
            'bestSellingProducts' => $bestSellingProducts,
        ]);
    }
}
