<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\ResCategory; // Import the ResCategory model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RestaurantAdminController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::orderBy('rs_id', 'desc')->get();
        return view('admin.all_restaurant', compact('restaurants'));
    }

    public function deleteRestaurant($rs_id)
    {
        // Menghapus data dari tabel 'restaurant' berdasarkan rs_id
        DB::table('restaurant')->where('rs_id', $rs_id)->delete();

        // Mengarahkan kembali ke halaman yang diinginkan setelah penghapusan
        return redirect()->route('admin.all_restaurant')->with('success', 'Restaurant berhasil dihapus');
    }

    public function editRestaurant($rs_id)
    {
        $restaurant = DB::table('restaurant')->where('rs_id', $rs_id)->first();
        $categories = DB::table('res_category')->get();

        if (!$restaurant) {
            abort(404); // Jika restoran tidak ditemukan, tampilkan 404
        }

        return view('admin.update_restaurant', compact('restaurant', 'categories'));
    }


    public function updateRestaurant(Request $request, $rs_id)
    {
        // Validasi input
        $request->validate([
            'c_name' => 'required',
            'title' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'url' => 'required|url',
            'o_hr' => 'required',
            'c_hr' => 'required',
            'o_days' => 'required',
            'address' => 'required',
            'file' => 'nullable|image|mimes:jpg,png,gif|max:1024'
        ]);

        // Jika ada file yang diupload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $file->move(public_path('Res_img'), $filename);
        } else {
            $filename = $request->input('current_image'); // Menggunakan gambar saat ini jika tidak ada gambar baru
        }

        // Update data di database
        DB::table('restaurant')->where('rs_id', $rs_id)->update([
            'c_id' => $request->input('c_name'),
            'title' => $request->input('title'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'url' => $request->input('url'),
            'o_hr' => $request->input('o_hr'),
            'c_hr' => $request->input('c_hr'),
            'o_days' => $request->input('o_days'),
            'address' => $request->input('address'),
            'image' => $filename,
            'date' => now(), // Menambahkan waktu update
        ]);

        return redirect()->route('admin.all_restaurant')->with('success', 'Restaurant berhasil diupdate!');
    }

    public function showCategory()
    {
        $categories = ResCategory::all(); // Fetch all categories from the database
        return view('admin.add_category', compact('categories')); // Pass categories to the view
    }

    public function storeCategory(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'c_name' => 'required|string|max:255',
        ]);

        // Check if category already exists
        $existingCategory = DB::table('res_category')->where('c_name', $request->c_name)->first();

        if ($existingCategory) {
            return redirect()->back()->withErrors(['c_name' => 'Category already exists!']);
        }

        // Insert the new category
        DB::table('res_category')->insert(['c_name' => $request->c_name]);

        // Redirect with success message
        return redirect()->back()->with('success', 'New Category Added Successfully.');
    }

    public function destroyCategory($c_id)
    {
        // Menghapus data dari tabel 'restaurant' berdasarkan rs_id
        DB::table('res_category')->where('c_id', $c_id)->delete();

        // Mengarahkan kembali ke halaman yang diinginkan setelah penghapusan
        return redirect()->route('admin.categories.create')->with('success', 'Category restaurant berhasil dihapus');
    }

    public function editCategory($c_id)
    {
        $categories = DB::table('res_category')->where('c_id', $c_id)->first();

        if (!$categories) {
            abort(404); // Jika restoran tidak ditemukan, tampilkan 404
        }

        return view('admin.update_category', compact('categories'));
    }

    public function updateCategory(Request $request, $c_id)
    {
        // Validasi input
        $request->validate([
            'c_name' => 'required|string|max:255',
        ]);

        // Temukan category berdasarkan id
        $category = ResCategory::find($c_id);

        if (!$category) {
            return redirect()->route('admin.categories.create')->with('error', 'Category not found.');
        }

        // Update data category
        $category->c_name = $request->input('c_name');
        $category->date = now(); 
        $category->save();

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('admin.categories.create')->with('success', 'Category updated successfully!');
    }


    public function createRestaurant()
    {
        $categories = DB::table('res_category')->get();
        return view('admin.add_restaurant', compact('categories')); // Pass categories to the view
    }

    public function createNewRestaurant(Request $request)
    {
        // Validasi input
        $request->validate([
            'c_name' => 'required',
            'res_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'url' => 'required|url',
            'o_hr' => 'required',
            'c_hr' => 'required',
            'o_days' => 'required',
            'address' => 'required',
            'file' => 'nullable|image|mimes:jpg,png,gif|max:1024'
        ]);

        // Jika ada file yang diupload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $file->move(public_path('Res_img'), $filename);
        } else {
            $filename = null; // Atur ke null jika tidak ada gambar yang diupload
        }

        // Menyimpan data baru di database
        DB::table('restaurant')->insert([
            'c_id' => $request->input('c_name'),
            'title' => $request->input('res_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'url' => $request->input('url'),
            'o_hr' => $request->input('o_hr'),
            'c_hr' => $request->input('c_hr'),
            'o_days' => $request->input('o_days'),
            'address' => $request->input('address'),
            'image' => $filename,
        ]);

        return redirect()->route('admin.all_restaurant')->with('success', 'Restaurant berhasil ditambahkan!');
    }
}
