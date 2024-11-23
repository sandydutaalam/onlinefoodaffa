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

    public function editOrder($o_id)
    {
        // $users_orders = DB::table('users_orders')->get();
        $users_orders = DB::table('users_orders')->where('o_id', $o_id)->first();
        // $categories = DB::table('res_category')->get();
        

        if (!$users_orders) {
            abort(404); // Jika order tidak ditemukan, tampilkan 404
        }

        return view('admin.all_orders', compact('users_orders', 'status'));
    }


    public function updateOrder(Request $request, $o_id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:on_the_way,delivered,rejected',
        ]);


        // Update data di database
        DB::table('users_orders')->where('o_id', $o_id)->update([
            'status' => $request->input('status'),
            'date' => now(), // Menambahkan waktu update
        ]);

        $users_orders = UserOrder::findOrFail($o_id);
        $users_orders->status = $request->status;
        $users_orders->save();

        return redirect()->route('admin.all_orders')->with('success', 'Status order berhasil diupdate!');
    }

    public function deleteOrder($o_id)
    {
        // Menghapus data dari tabel 'order' berdasarkan o_id
        DB::table('users_orders')->where('o_id', $o_id)->delete();

        // Mengarahkan kembali ke halaman yang diinginkan setelah penghapusan
        return redirect()->route('admin.all_orders')->with('success', 'Order berhasil dihapus');
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
    
    public function destroyCategory($o_id)
    {
        // Menghapus data dari tabel 'orders' berdasarkan rs_id
        DB::table('users_orders')->where('o_id', $o_id)->delete();

        // Mengarahkan kembali ke halaman yang diinginkan setelah penghapusan
        return redirect()->route('admin.categories.create')->with('success', 'Restaurant berhasil dihapus');
    }

  
    
}
