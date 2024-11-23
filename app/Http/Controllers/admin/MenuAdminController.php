<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuAdminController extends Controller
{
    public function index()
    {
        $dishs = Dish::orderBy('rs_id', 'desc')->get();
        return view('admin.all_menu', compact('dishs'));
    }

    public function deleteMenu($d_id)
    {
        // Menghapus data dari tabel 'restaurant' berdasarkan rs_id
        DB::table('dishes')->where('d_id', $d_id)->delete();

        // Mengarahkan kembali ke halaman yang diinginkan setelah penghapusan
        return redirect()->route('admin.all_menu')->with('success', 'Restaurant berhasil dihapus');
    }

    public function editMenu($d_id)
    {
        $dishes = DB::table('dishes')->where('d_id', $d_id)->first();
        $restaurants = DB::table('restaurant')->get();

        if (!$dishes) {
            abort(404); // Jika restoran tidak ditemukan, tampilkan 404
        }

        return view('admin.update_menu', compact('dishes', 'restaurants'));
    }

    public function createMenu()
    {
        $menues = Dish::all(); // Fetch all categories from the database
        $restaurants = DB::table('restaurant')->get();
        return view('admin.add_menu', compact('restaurants')); // Pass categories to the view
    }

    public function createNewMenu(Request $request)
    {
        // Validasi input
        $request->validate([
            'd_name' => 'required|string|max:255',
            'about' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|image|mimes:jpg,png,gif|max:1024',
            'res_name' => 'required|exists:restaurant,rs_id',
        ]);

        // Jika ada file yang diupload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Res_img/dishes/'), $filename);
        }

        // Simpan data ke database
        DB::table('dishes')->insert([
            'rs_id' => $request->input('res_name'),
            'title' => $request->input('d_name'),
            'slogan' => $request->input('about'),
            'price' => $request->input('price'),
            'img' => $filename,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.all_menu')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function updateMenu(Request $request, $d_id)
    {
        // Validasi input
        $request->validate([
            'd_name' => 'required|string|max:255',
            'about' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'nullable|image|mimes:jpg,png,gif|max:1024',
            'res_name' => 'required|exists:restaurant,rs_id',
        ]);

        // Temukan dish berdasarkan id
        $dish = DB::table('dishes')->where('d_id', $d_id)->first();

        if (!$dish) {
            return redirect()->route('admin.all_menu')->with('error', 'Dish not found.');
        }

        // Proses update data
        $data = [
            'title' => $request->input('d_name'),
            'slogan' => $request->input('about'),
            'price' => $request->input('price'),
            'rs_id' => $request->input('res_name'),
        ];

        // Jika ada file yang diupload, update gambarnya
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Res_img/dishes/'), $filename);

            // Tambahkan nama file gambar ke data yang diupdate
            $data['img'] = $filename;
        }

        // Update data di database
        DB::table('dishes')->where('d_id', $d_id)->update($data);

        // Redirect ke halaman daftar menu dengan pesan sukses
        return redirect()->route('admin.all_menu')->with('success', 'Menu updated successfully!');
    }
}
