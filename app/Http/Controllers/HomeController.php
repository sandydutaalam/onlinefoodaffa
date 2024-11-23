<?php

namespace App\Http\Controllers;
use App\Models\Dish;
use App\Models\Restaurant;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 data dari tabel dishes
        $dishes = Dish::limit(6)->get();
        
        // Ambil semua data dari tabel restaurant
        $restaurants = Restaurant::all(); // Pastikan ini sudah benar

        // Kirim data ke view
        return view('index', compact('dishes', 'restaurants'));
    }
}
