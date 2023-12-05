<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReminderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\ManufacturerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])
        ->name('admin.')
        ->prefix('admin')
        ->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::resource('categories', CategoryController::class);
            Route::resource('parts', PartController::class);
            //Route::resource('suppliers', SupplierController::class);
            Route::resource('orders', OrderController::class);
            Route::resource('orderitems', OrderItemController::class);
            Route::resource('manufacturers', ManufacturerController::class);
            Route::post('orderitems/changeStatus/{id}', [OrderItemController::class, 'changeStatus'])->name('orderitems.changeStatus');
            Route::delete('parts/deleteImage/{part}', [PartController::class, 'deleteImage'])->name('parts.deleteImage');
});
        
Route::get('{any?}', function() {
    return view('guest.home');
})->where('any', '.*');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
