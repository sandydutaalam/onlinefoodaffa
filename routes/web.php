<?php

use App\Http\Controllers\admin\MenuAdminController;
use App\Http\Controllers\admin\OrderAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\admin\RestaurantAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantsController;
use App\Http\Middleware\AdminAuth;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/restaurants', [RestaurantsController::class, 'index'])->name('restaurants');
Route::get('/dishes/{res_id}', [DishesController::class, 'show'])->name('dishes.show');
Route::post('/dishes/{res_id}/add', [DishesController::class, 'addDish'])->name('dishes.add');

Route::get('/checkout', [DishesController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout', [DishesController::class, 'placeOrder'])->name('checkout.process');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'login'])->name('admin.login.submit');

// Group middleware untuk route yang membutuhkan otentikasi admin
Route::middleware([AdminAuth::class])->group(function () {
    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // All-restaurant
    Route::get('/admin/all_restaurant', [RestaurantAdminController::class, 'index'])->name('admin.all_restaurant');
    Route::delete('/admin/all_restaurant/{rs_id}/delete', [RestaurantAdminController::class, 'deleteRestaurant'])->name('admin.all_restaurant.delete');
    Route::get('/admin/all_restaurant/{rs_id}/edit', [RestaurantAdminController::class, 'editRestaurant'])->name('admin.all_restaurant.edit');
    Route::put('/admin/all_restaurant/{rs_id}/update', [RestaurantAdminController::class, 'updateRestaurant'])->name('admin.all_restaurant.update');

    // Add Category
    Route::get('/admin/categories/create', [RestaurantAdminController::class, 'showCategory'])->name('admin.categories.create');
    Route::post('/admin/categories/addNew', [RestaurantAdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/admin/categories/{c_id}/delete', [RestaurantAdminController::class, 'destroyCategory'])->name('admin.categories.delete');
    Route::get('/admin/categories/{c_id}/edit', [RestaurantAdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/admin/categories/{c_id}/update', [RestaurantAdminController::class, 'updateCategory'])->name('admin.categories.update');

    // Add Restaurant
    Route::get('/admin/restaurant/create', [RestaurantAdminController::class, 'createRestaurant'])->name('admin.restaurants.create');
    Route::post('/admin/restaurant/save', [RestaurantAdminController::class, 'createNewRestaurant'])->name('admin.restaurants.save');

    // All Menu
    Route::get('/admin/all_menu', [MenuAdminController::class, 'index'])->name('admin.all_menu');
    Route::delete('/admin/all_menu/{d_id}/delete', [MenuAdminController::class, 'deleteMenu'])->name('admin.all_menu.delete');
    Route::get('/admin/all_menu/{d_id}/edit', [MenuAdminController::class, 'editMenu'])->name('admin.all_menu.edit');
    Route::put('/admin/all_menu/{d_id}/update', [MenuAdminController::class, 'updateMenu'])->name('admin.all_menu.update');

    // Add Menu
    Route::get('/admin/menu/create', [MenuAdminController::class, 'createMenu'])->name('admin.menues.create');
    Route::post('/admin/menu/save', [MenuAdminController::class, 'createNewMenu'])->name('admin.menues.save');

    // Orders
    Route::get('/admin/order', [OrderAdminController::class, 'index'])->name('admin.all_orders');
    Route::get('/admin/order/{o_id}/view', [OrderAdminController::class, 'viewOrder'])->name('admin.all_orders.view');

    // Laporan
    Route::get('/userorders/monthly-report', [OrderAdminController::class, 'monthlyReport'])->name('userorders.monthlyReport');


    // Logout
    Route::post('/admin/logout', [AdminController::class, 'logout'  ])->name('admin.logout');
});
