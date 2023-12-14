<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProfileController;
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

    Route::get('/', function () {
        return view('index');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {

        Route::get('', [CategoriesController::class, 'index'])->name('index');
        Route::post('', [CategoriesController::class, 'store'])->name('store');
        Route::get('create', [CategoriesController::class, 'create'])->name('create');
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])->name('edit');
        Route::patch('{id}', [CategoriesController::class, 'update'])->name('update');
        Route::delete('{id}', [CategoriesController::class, 'destroy'])->name('destroy');

    });

});

require __DIR__.'/auth.php';
