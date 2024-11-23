<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = md5($request->input('password')); // Using MD5, not recommended for production

        $admin = DB::table('admin')->where('username', $username)->where('password', $password)->first();

        if ($admin) {
            session(['adm_id' => $admin->adm_id]);
            session(['role' => $admin->role]);
            if ($admin->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.all_orders');
            }
        } else {
            return redirect()->back()->withErrors(['Invalid Username or Password!']);
        }
    }

    public function dashboard()
    { {
            $restaurantsCount = DB::table('restaurant')->count();
            $dishesCount = DB::table('dishes')->count();
            $ordersCount = DB::table('users_orders')->count();
            $categoryCount = DB::table('res_category')->count();
            $processingOrders = DB::table('users_orders')->where('status', 'in process')->count();
            $deliveredOrders = DB::table('users_orders')->where('status', 'closed')->count();
            $cancelledOrders = DB::table('users_orders')->where('status', 'rejected')->count();
            $totalEarnings = DB::table('users_orders')
                ->where('status', 'closed')
                ->sum('price');

            return view('admin.dashboard', compact(
                'restaurantsCount',
                'dishesCount',
                'ordersCount',
                'categoryCount',
                'processingOrders',
                'deliveredOrders',
                'cancelledOrders',
                'totalEarnings'
            ));
        }
    }

    public function logout(Request $request)
    {
        // Clear the admin session
        $request->session()->forget('adm_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Logged out successfully!');
    }
}
