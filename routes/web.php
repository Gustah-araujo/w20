<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockMovementsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardsController::class, 'index']);

    Route::group(['prefix' => 'dashboards', 'as' => 'dashboards.'], function() {

        Route::get('{year}/top_products', [DashboardsController::class, 'top_products_sales'])->name('top_products_sales');

    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {

        Route::get('', [CategoriesController::class, 'index'])->name('index');
        Route::post('', [CategoriesController::class, 'store'])->name('store');
        Route::get('create', [CategoriesController::class, 'create'])->name('create');
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])->name('edit');
        Route::patch('{id}', [CategoriesController::class, 'update'])->name('update');
        Route::delete('{id}', [CategoriesController::class, 'destroy'])->name('destroy');

    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function() {

        Route::get('', [ProductsController::class, 'index'])->name('index');
        Route::get('stock', [ProductsController::class, 'stock'])->name('stock');
        Route::post('', [ProductsController::class, 'store'])->name('store');
        Route::get('create', [ProductsController::class, 'create'])->name('create');
        Route::get('edit/{id}', [ProductsController::class, 'edit'])->name('edit');
        Route::patch('{id}', [ProductsController::class, 'update'])->name('update');
        Route::delete('{id}', [ProductsController::class, 'destroy'])->name('destroy');

        Route::group(['prefix' => '{id}/stock_movements', 'as' => 'stock_movements.'], function() {

            Route::get('', [StockMovementsController::class, 'index'])->name('index');
            Route::post('', [StockMovementsController::class, 'store'])->name('store');
            Route::get('create', [StockMovementsController::class, 'create'])->name('create');
            Route::delete('{stock_movement_id}', [StockMovementsController::class, 'destroy'])->name('destroy');

        });
    });


});

require __DIR__.'/auth.php';
