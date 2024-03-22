<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['data' => Item::all()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/item', ItemController::class);
Route::get('/barang/store-after-login', [ItemController::class, 'storeAfterLogin'])->name('item.storeAfterLogin');

require __DIR__ . '/auth.php';
