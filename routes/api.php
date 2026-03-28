<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    UnitController,
    CategoryController,
    ProductController,
    ProductVariantController,
    SupplierController,
    ServiceController,
    ServiceVariantController,
    CustomerTypeController,
    CustomerController,
    OrderController,
    OrderItemController,
    QuotationController,
    InvoiceController,
    ProjectController,
    ProjectServiceController,
    ProjectMovementController,
    InventoryMovementController
};
 

// Auth Routes (sin protección)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Auth Routes (protegidas)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
});

// API Routes protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'units' => UnitController::class,
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'product-variants' => ProductVariantController::class,
        'suppliers' => SupplierController::class,
        'services' => ServiceController::class,
        'service-variants' => ServiceVariantController::class,
        'customer-types' => CustomerTypeController::class,
        'customers' => CustomerController::class,
        'orders' => OrderController::class,
        'order-items' => OrderItemController::class,
        'quotations' => QuotationController::class,
        'invoices' => InvoiceController::class,
        'projects' => ProjectController::class,
        'project-services' => ProjectServiceController::class,
        'project-movements' => ProjectMovementController::class,
        'inventory-movements' => InventoryMovementController::class,
    ]);
});