<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\SupplierController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/proyectos', function () {
    return view('proyectos');
})->name('proyectos');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Ruta para enviar el formulario de contacto
Route::post('/api/contact', [ContactController::class, 'store']);
// API Routes
Route::prefix('api')->group(base_path('routes/api.php'));


// Admin Auth (no middleware)
    Route::get('admin/login',  [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('admin/logout',[AdminAuthController::class, 'logout'])->name('admin.logout');

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
