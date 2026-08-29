<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');


Route::post('/login', function () {

    $credentials = request()->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

        request()->session()->regenerate();

        return redirect()->route('dashboard');
    }

    return back()
        ->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])
        ->onlyInput('email');

})->middleware('guest')->name('login.submit');


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect()->route('login');

})->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| 1. KHUSUS ADMIN (Admin Only)
|--------------------------------------------------------------------------
| Dibatasi khusus Admin: Hapus Produk & Manajemen User (CRUD).
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:Admin'
])->group(function () {

    // Hapus Produk (Hanya Admin)
    Route::delete('/products/{product}', [
        ProductController::class,
        'destroy'
    ])->name('products.destroy');

    // Manajemen User (Hanya Admin)
    Route::get('/users', [
        UserController::class,
        'index'
    ])->name('users.index');

    Route::get('/users/create', [
        UserController::class,
        'create'
    ])->name('users.create');

    Route::post('/users', [
        UserController::class,
        'store'
    ])->name('users.store');

    Route::get('/users/{user}', [
        UserController::class,
        'show'
    ])->name('users.show');

    Route::get('/users/{user}/edit', [
        UserController::class,
        'edit'
    ])->name('users.edit');

    Route::put('/users/{user}', [
        UserController::class,
        'update'
    ])->name('users.update');

    Route::delete('/users/{user}', [
        UserController::class,
        'destroy'
    ])->name('users.destroy');

});


/*
|--------------------------------------------------------------------------
| 2. MANAJEMEN GUDANG (Admin & Manajer Gudang)
|--------------------------------------------------------------------------
| Dibatasi untuk Admin dan Manajer Gudang:
| Mutasi Produk (Create & Edit), Mutasi Kategori, Mutasi Supplier,
| Approval Status Transaksi Stok, dan Laporan.
| Catatan: Route create/edit didaftarkan sebelum route show umum.
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:Admin,Manajer Gudang'
])->group(function () {

    // Mutasi Produk (Tambah & Edit)
    Route::get('/products/create', [
        ProductController::class,
        'create'
    ])->name('products.create');

    Route::post('/products', [
        ProductController::class,
        'store'
    ])->name('products.store');

    Route::get('/products/{product}/edit', [
        ProductController::class,
        'edit'
    ])->name('products.edit');

    Route::put('/products/{product}', [
        ProductController::class,
        'update'
    ])->name('products.update');

    // Mutasi Kategori (Tambah, Edit, Hapus)
    Route::get('/categories/create', [
        CategoryController::class,
        'create'
    ])->name('categories.create');

    Route::post('/categories', [
        CategoryController::class,
        'store'
    ])->name('categories.store');

    Route::get('/categories/{category}/edit', [
        CategoryController::class,
        'edit'
    ])->name('categories.edit');

    Route::put('/categories/{category}', [
        CategoryController::class,
        'update'
    ])->name('categories.update');

    Route::delete('/categories/{category}', [
        CategoryController::class,
        'destroy'
    ])->name('categories.destroy');

    // Mutasi Supplier (Tambah, Edit, Hapus)
    Route::get('/suppliers/create', [
        SupplierController::class,
        'create'
    ])->name('suppliers.create');

    Route::post('/suppliers', [
        SupplierController::class,
        'store'
    ])->name('suppliers.store');

    Route::get('/suppliers/{supplier}/edit', [
        SupplierController::class,
        'edit'
    ])->name('suppliers.edit');

    Route::put('/suppliers/{supplier}', [
        SupplierController::class,
        'update'
    ])->name('suppliers.update');

    Route::delete('/suppliers/{supplier}', [
        SupplierController::class,
        'destroy'
    ])->name('suppliers.destroy');

    // Approval Status Transaksi Stok (Fase 2)
    Route::put('/stock-transactions/{id}/status', [
        StockTransactionController::class,
        'updateStatus'
    ])->name('stock-transactions.update-status');

    // Laporan Stok & Transaksi
    Route::get('/reports/stock', [
        ReportController::class,
        'stock'
    ])->name('reports.stock');

    Route::get('/reports/transactions', [
        ReportController::class,
        'transactions'
    ])->name('reports.transactions');

});


/*
|--------------------------------------------------------------------------
| 3. AKSES UMUM AUTENTIKASI (Admin, Manajer Gudang, Staff Gudang)
|--------------------------------------------------------------------------
| Terbuka untuk semua role yang telah login:
| Dashboard, Read-only Produk, Read-only Kategori, Read-only Supplier,
| Operasional Transaksi Stok (Index/Create/Store/Show),
| Operasional Stock Opname (Index/Create/Store/Show).
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:Admin,Manajer Gudang,Staff Gudang'
])->group(function () {

    // Dashboard
    Route::get('/', [
        DashboardController::class,
        'index'
    ])->name('home');

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    // Read-only Produk
    Route::get('/products', [
        ProductController::class,
        'index'
    ])->name('products.index');

    Route::get('/products/{product}', [
        ProductController::class,
        'show'
    ])->name('products.show');

    // Read-only Kategori (Staff Gudang dapat membaca)
    Route::get('/categories', [
        CategoryController::class,
        'index'
    ])->name('categories.index');

    Route::get('/categories/{category}', [
        CategoryController::class,
        'show'
    ])->name('categories.show');

    // Read-only Supplier (Staff Gudang dapat membaca)
    Route::get('/suppliers', [
        SupplierController::class,
        'index'
    ])->name('suppliers.index');

    Route::get('/suppliers/{supplier}', [
        SupplierController::class,
        'show'
    ])->name('suppliers.show');

    // Transaksi Stok Operasional
    Route::get('/stock-transactions', [
        StockTransactionController::class,
        'index'
    ])->name('stock-transactions.index');

    Route::get('/stock-transactions/create', [
        StockTransactionController::class,
        'create'
    ])->name('stock-transactions.create');

    Route::post('/stock-transactions', [
        StockTransactionController::class,
        'store'
    ])->name('stock-transactions.store');

    Route::get('/stock-transactions/{id}', [
        StockTransactionController::class,
        'show'
    ])->name('stock-transactions.show');

    // Stock Opname Operasional
    Route::get('/stock-opnames', [
        StockOpnameController::class,
        'index'
    ])->name('stock-opnames.index');

    Route::get('/stock-opnames/create', [
        StockOpnameController::class,
        'create'
    ])->name('stock-opnames.create');

    Route::post('/stock-opnames', [
        StockOpnameController::class,
        'store'
    ])->name('stock-opnames.store');

    Route::get('/stock-opnames/{stockOpname}', [
        StockOpnameController::class,
        'show'
    ])->name('stock-opnames.show');

});