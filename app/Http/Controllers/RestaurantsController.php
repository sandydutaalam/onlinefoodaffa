<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;

use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel restaurant
        $restaurants = Restaurant::all(); // Pastikan ini sudah benar

        // Kirim data ke view
        return view('restaurants', compact('restaurants'));
    }
}
