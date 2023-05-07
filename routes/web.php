<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\KategoriController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BukuController::class, 'home'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/buku',BukuController::class);
    Route::resource('/penerbit',PenerbitController::class);
    Route::resource('/kategori',KategoriController::class);

    Route::get('buku/delete/{id}', [BukuController::class, 'delete'])->name('buku.delete');
    Route::get('penerbit/delete/{id}', [PenerbitController::class, 'delete'])->name('penerbit.delete');
    Route::get('kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');



    Route::get('/admin', [BukuController::class, 'admin'])->name('admin');
    Route::get('/pengadaan', [BukuController::class, 'pengadaan'])->name('pengadaan');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
