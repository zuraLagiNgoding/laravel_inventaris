<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
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

Route::get('/', function () {
    if (Route::has("login")) {
        return redirect("/dashboard");
    } else {
        return redirect("login");
    }
});

Route::middleware('auth', 'role:ADMIN')->group(function () {
    // category barang routes
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/save', [CategoryController::class, 'create'])->name('category.save');
Route::post('/category/save', [CategoryController::class, 'store'])->name('category.save');
Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.edit');

// barang routes
Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::get('/barang/save', [BarangController::class, 'create'])->name('barang.save');
Route::post('/barang/save', [BarangController::class, 'store'])->name('barang.save');
Route::get('/barang/{id}', [BarangController::class, 'edit'])->name('barang.edit');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.edit');

// ruangan routes
Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan');
Route::get('/ruangan/save', [RuanganController::class, 'create'])->name('ruangan.save');
Route::post('/ruangan/save', [RuanganController::class, 'store'])->name('ruangan.save');
Route::get('/ruangan/{id}', [RuanganController::class, 'edit'])->name('ruangan.edit');
Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.edit');
});

//pembelian routes
Route::middleware('auth', 'role:ADMIN,OPERATOR,PETUGAS')->group(function () {
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian');
    Route::get('/pembelian/save', [PembelianController::class, 'create'])->name('pembelian.save');
    Route::post('/pembelian/save', [PembelianController::class, 'store'])->name('pembelian.save');
    Route::get('/pembelian/{id}', [PembelianController::class, 'edit'])->name('pembelian.edit');
    Route::delete('/pembelian/{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');
    Route::put('/pembelian/{id}', [PembelianController::class, 'update'])->name('pembelian.edit');
});

//pemakaian routes
Route::middleware('auth', 'role:ADMIN,OPERATOR')->group(function () {
    Route::get('/pemakaian', [PemakaianController::class, 'index'])->name('pemakaian');
    Route::get('/pemakaian/save', [PemakaianController::class, 'create'])->name('pemakaian.save');
    Route::post('/pemakaian/save', [PemakaianController::class, 'store'])->name('pemakaian.save');
    Route::get('/pemakaian/{id}', [PemakaianController::class, 'edit'])->name('pemakaian.edit');
    Route::delete('/pemakaian/{id}', [PemakaianController::class, 'destroy'])->name('pemakaian.destroy');
    Route::put('/pemakaian/{id}', [PemakaianController::class, 'update'])->name('pemakaian.edit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
