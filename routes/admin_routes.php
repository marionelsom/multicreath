<?php
// ============================================================
// ADD THIS TO YOUR routes/web.php
// ============================================================

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\SupplierController;

// Admin Auth (no middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AdminAuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/variants', [ProductController::class, 'storeVariant'])->name('products.variants.store');
    Route::put('variants/{variant}', [ProductController::class, 'updateVariant'])->name('variants.update');

    // Services
    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/variants', [ServiceController::class, 'storeVariant'])->name('services.variants.store');

    // Customers
    Route::resource('customers', CustomerController::class)->except(['destroy']);

    // Orders
    Route::resource('orders', OrderController::class)->except(['edit', 'update', 'destroy']);
    Route::patch('orders/{order}/status',  [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::patch('orders/{order}/payment', [OrderController::class, 'updatePayment'])->name('orders.payment');

    // Projects
    Route::resource('projects', ProjectController::class)->except(['destroy']);
    Route::post('projects/{project}/movements', [ProjectController::class, 'addMovement'])->name('projects.movements.store');
    Route::post('projects/{project}/services',  [ProjectController::class, 'addService'])->name('projects.services.store');

    // Inventory
    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('inventory/{variant}/movements', [InventoryController::class, 'movements'])->name('inventory.movements');
    Route::post('inventory/movement', [InventoryController::class, 'storeMovement'])->name('inventory.movement.store');

    // Suppliers
    Route::resource('suppliers', SupplierController::class)->except(['show']);
});
