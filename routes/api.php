<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    BannerController,
    CategoryController,
    ProductController,
    OrdersController,
    ExtraProductController,
    AllergyController,
    ShippingFeeController,
    SalesReportController,
ExtraCategoryController,
    ReservationController,
PartnersController,
FeedbackController,
DocumentController,
MessageController,
MenuController,
TableCategoryController,
RestaurantTableController,
TableOrderController

};


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


    Route::resource('banners', BannerController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('messages', MessageController::class);
 
 
    Route::get('partners',[PartnersController::class,'index']);
    Route::get('menu',[MenuController::class,'index']);
    Route::get('categories', [CategoryController::class,'index']);

    
    Route::get('products/category/{id}',[ProductController::class,'getProductsByCategory']);
    Route::get('products/suggest',[ProductController::class,'getSuggest']);
    Route::post('order/submit',[OrdersController::class,'submit']);


    Route::get('shipping',[ShippingFeeController::class,'index']);
    
    
    Route::get('feedbacks',[FeedbackController::class,'index']);
    Route::post('feedback',[FeedbackController::class,'store']);
    

    Route::post('contact', [ReservationController::class,'store']);

    // Table Management API Routes
    Route::prefix('table-management')->group(function () {
        // Table Categories
        Route::get('categories', [TableCategoryController::class, 'apiIndex']);
        Route::get('categories/{category}', [TableCategoryController::class, 'apiShow']);
        Route::post('categories', [TableCategoryController::class, 'apiStore']);
        Route::put('categories/{category}', [TableCategoryController::class, 'apiUpdate']);
        Route::delete('categories/{category}', [TableCategoryController::class, 'apiDestroy']);

        // Restaurant Tables
        Route::get('tables', [RestaurantTableController::class, 'apiIndex']);
        Route::get('tables/{table}', [RestaurantTableController::class, 'apiShow']);
        Route::post('tables', [RestaurantTableController::class, 'apiStore']);
        Route::put('tables/{table}', [RestaurantTableController::class, 'apiUpdate']);
        Route::delete('tables/{table}', [RestaurantTableController::class, 'apiDestroy']);
        Route::get('tables/category/{categoryId}', [RestaurantTableController::class, 'getTablesByCategory']);

        // Table Orders
        Route::get('orders', [TableOrderController::class, 'apiIndex']);
        Route::get('orders/{order}', [TableOrderController::class, 'apiShow']);
        Route::post('orders', [TableOrderController::class, 'apiStore']);
        Route::put('orders/{order}', [TableOrderController::class, 'apiUpdate']);
        Route::delete('orders/{order}', [TableOrderController::class, 'apiDestroy']);
        Route::put('orders/{order}/close', [TableOrderController::class, 'apiCloseOrder']);
        Route::put('orders/{order}/cancel', [TableOrderController::class, 'apiCancelOrder']);

        // Table Order Items
        Route::post('orders/{order}/items', [TableOrderController::class, 'apiAddItem']);
        Route::put('orders/{order}/items/{item}', [TableOrderController::class, 'apiUpdateItem']);
        Route::delete('orders/{order}/items/{item}', [TableOrderController::class, 'apiRemoveItem']);

        // Waiter specific routes
        Route::get('waiter/{waiterId}/orders', [TableOrderController::class, 'getWaiterOrders']);
        Route::get('waiter/{waiterId}/active-orders', [TableOrderController::class, 'getWaiterActiveOrders']);

        // Table status management
        Route::put('tables/{table}/status', [RestaurantTableController::class, 'updateTableStatus']);
        Route::get('tables/available', [RestaurantTableController::class, 'getAvailableTables']);
        Route::get('tables/occupied', [RestaurantTableController::class, 'getOccupiedTables']);

        // Additional utility endpoints
        Route::get('dashboard/stats', [TableOrderController::class, 'getDashboardStats']);
        Route::get('products', [TableOrderController::class, 'getProducts']);
        Route::get('waiters', [TableOrderController::class, 'getWaiters']);
    });
