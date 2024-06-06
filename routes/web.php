<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillController;
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
Route::get('/',[HomeController::class,'index'])->name('index');
Route::patch('/rateProduct/{id}',[HomeController::class,'rateProduct'])->middleware('auth');
Route::post('/addToCard',[HomeController::class,'addToCard'])->middleware('auth')->name('addToCard');
Route::resource('/product', ProductController::class)->middleware('auth');
Route::resource('/bill',BillController::class)->middleware('auth');
Route::get('/myCard',[HomeController::class,'myCard'])->middleware('auth')->name('myCard');
Route::post('/removeFromCard',[HomeController::class,'removeFromCard'])->middleware('auth')->name('removeFromCard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__.'/auth.php';
