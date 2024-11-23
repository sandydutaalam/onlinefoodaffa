<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DishesController extends Controller
{
    public function show($res_id)
    {
        // Fetch the restaurant based on rs_id
        $restaurant = Restaurant::where('rs_id', $res_id)->firstOrFail();

        // Fetch dishes related to the restaurant
        $dishes = Dish::where('rs_id', $res_id)->get();

        // Send data to the view
        return view('dishes', compact('restaurant', 'dishes'));
    }

    public function addDish(Request $request, $res_id)
    {
        // Get dish ID and quantity from the request
        $dish_id = $request->input('id');
        $quantity = $request->input('quantity');
        $note  = $request->input('note');

        // Fetch the dish from the database
        $dish = Dish::findOrFail($dish_id);

        // Get the current cart session or initialize an empty array if it doesn't exist
        $cart = session()->get('cart_item', []);

        // If the dish already exists in the cart, update its quantity
        if (isset($cart[$dish_id])) {
            $cart[$dish_id]['quantity'] += $quantity;
        } else {
            // Add the dish to the cart with its details
            $cart[$dish_id] = [
                'd_id' => $dish->d_id,
                'title' => $dish->title,
                'price' => $dish->price,
                'quantity' => $quantity,
                'note' => $note,
            ];
        }

        // Update the session with the new cart data
        session()->put('cart_item', $cart);

        // Redirect back to the dishes page
        return redirect()->route('dishes.show', ['res_id' => $res_id]);
    }

    public function showCheckout()
    {
        $cartItems = session()->get('cart_item', []);
        $itemTotal = 0;

        foreach ($cartItems as $item) {
            $itemTotal += ($item['price'] * $item['quantity']);
        }

        $restaurantCharge = $itemTotal * 0.10;
        $total = $itemTotal + $restaurantCharge;

        return view('checkout', compact('cartItems', 'itemTotal', 'restaurantCharge', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $cartItems = session()->get('cart_item', []);
        if (!$cartItems) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $tableNumber = $request->input('table_number');

        foreach ($cartItems as $item) {
            DB::table('users_orders')->insert([
                'table_number' => $tableNumber,
                'title' => $item['title'],
                'quantity' => $item['quantity'],
                'note' => $item['note'] ?? null,
                'price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        // Hapus session cart setelah pesanan diproses
        session()->forget('cart_item');

        return redirect()->route('home')->with('success', 'Thank you. Your order has been placed!');
    }
}
