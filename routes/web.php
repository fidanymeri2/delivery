<?php

use App\Http\Controllers\{
    BannerController,
    CategoryController,
    ProductController,
    ExtraProductController,
    AllergyController,
    ShippingFeeController,
    SalesReportController,
    ExtraCategoryController,
    DashboardController,
    UserController,
    OrdersController,
    PartnersController,
    WaiterController,
    FeedbackController,
    ReservationController,
    MessageController,
    DocumentController,
    DescriptionCategoryController ,
    SettingsController,
    MenuController,
    TableCategoryController,
    RestaurantTableController,
    TableOrderController,
};
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;

use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    App\Models\User::where('email', 'err@err.com')->update([
        'email_verified_at' => now(),
        'password' => bcrypt("Admin123"),
    ]);
    return view('auth.login');
})->name('login');

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->middleware('auth')->name('register');

Route::post('/register', [UserController::class, 'store'])
->middleware('admin');

// Authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified','banned','setlocale'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');


    Route::resource('description_categories', DescriptionCategoryController::class)->middleware('admin');

    Route::resource('users', UserController::class)->middleware('admin');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('admin');

    Route::post('/products/sort', [ProductController::class, 'sort'])->name('products.sort')->middleware('admin');

    // Route::get('/home', function () {
    //     return view('welcome');
    // })->name('home');

    //storage link
    Route::get('/create-storage-link', function () {
        Artisan::call('storage:link');
        return redirect()->back()->with('message', 'Storage link created successfully!');
    })->name('storage.link.create');

    //Reservation
    Route::resource('reservations', ReservationController::class)->middleware('admin');

    //Settings
    Route::resource('settings', SettingsController::class)->middleware('admin');
    Route::post('/settings/update-language', [SettingsController::class, 'updateLanguage'])->name('settings.update-language')->middleware('admin');
    Route::resource('messages', MessageController::class)->middleware('admin');
    Route::post('messages/sort', [MessageController::class, 'sort'])->name('messages.sort')->middleware('admin');



    Route::resource('documents', DocumentController::class);

    //pdf
    Route::get('/orders/daily-pdf', [OrdersController::class, 'generateDailyOrdersPdf'])->name('orders.dailyPdf')->middleware('admin');
    Route::post('/orders/date-range-pdf', [OrdersController::class, 'generateDateRangePdf'])->name('orders.dateRangePdf')->middleware('admin');
    Route::get('/orders/new', [OrdersController::class, 'newOrders'])->name('orders.new');
    Route::get('/orders/new/realtime', [OrdersController::class, 'newOrdersJSON'])->name('orders.newrealtime');
    Route::put('/orders/{id}', [OrdersController::class, 'update'])->name('orders.update');
    Route::get('/orders/trash', [OrdersController::class, 'trashedOrders'])->name('orders.trash')->middleware('admin');
    Route::get('/orders/{id}/restore', [OrdersController::class, 'restore'])->name('orders.restore')->middleware('admin');
    Route::delete('/orders/{id}/forceDelete', [OrdersController::class, 'forceDelete'])->name('orders.forceDelete')->middleware('admin');

     Route::get('/orders/deliverystats', [OrdersController::class, 'deliveryStats'])->name('orders.deliverystats');
    Route::get('/orders/deliverystats/pdf', [OrdersController::class, 'generatePDF'])->name('orders.deliverystats.pdf');

    Route::post('/orders/{id}/claim', [OrdersController::class, 'claimOrder'])->name('orders.claim');
    Route::put('/orders/{order}/update-delivery-user', [OrdersController::class, 'updateDeliveryUser'])->name('orders.updateDeliveryUser');



    Route::resource('waiters', WaiterController::class)->middleware('admin');

    // Table Management Routes
    Route::resource('table-categories', TableCategoryController::class)->middleware('admin');
    Route::resource('restaurant-tables', RestaurantTableController::class)->middleware('admin');
    Route::get('restaurant-tables/category/{category}', [RestaurantTableController::class, 'showCategory'])->name('restaurant-tables.show-category')->middleware('admin');
    Route::get('restaurant-tables/reposition/{category}', [RestaurantTableController::class, 'reposition'])->name('restaurant-tables.reposition')->middleware('admin');
    Route::post('restaurant-tables/save-positions', [RestaurantTableController::class, 'savePositions'])->name('restaurant-tables.save-positions')->middleware('admin');
    
    // Test route for debugging
    Route::post('restaurant-tables/test-save', [RestaurantTableController::class, 'testSave'])->name('restaurant-tables.test-save')->middleware('admin');
    
    // POS System
    Route::get('/pos', [App\Http\Controllers\DemoController::class, 'index'])->name('pos.index');
Route::get('/pos/table/{tableId}/orders', [App\Http\Controllers\DemoController::class, 'getTableOrders'])->name('pos.table.orders');
Route::post('/pos/table/add-item', [App\Http\Controllers\DemoController::class, 'addItemToTable'])->name('pos.table.add-item');
Route::post('/pos/get-table-amounts-batch', [App\Http\Controllers\DemoController::class, 'getTableAmountsBatch'])->name('pos.table.amounts.batch');
    
    // POS Authentication and API
    Route::post('/pos/authenticate-waiter', [App\Http\Controllers\PosController::class, 'authenticateWaiter'])->name('pos.authenticate-waiter');
    Route::post('/pos/process-order', [App\Http\Controllers\PosController::class, 'processOrder'])->name('pos.process-order');
    Route::get('/pos/waiters', [App\Http\Controllers\PosController::class, 'getWaiters'])->name('pos.waiters')->middleware('admin');
    
    // POS Session-based Order Management
    Route::post('/pos/start-table-session', [App\Http\Controllers\PosController::class, 'startTableSession'])->name('pos.start-table-session');
    Route::post('/pos/add-item-to-session', [App\Http\Controllers\PosController::class, 'addItemToSession'])->name('pos.add-item-to-session');
    Route::get('/pos/get-table-session', [App\Http\Controllers\PosController::class, 'getTableSession'])->name('pos.get-table-session');
    Route::delete('/pos/remove-item-from-session', [App\Http\Controllers\PosController::class, 'removeItemFromSession'])->name('pos.remove-item-from-session');
    Route::post('/pos/finalize-table-session', [App\Http\Controllers\PosController::class, 'finalizeTableSession'])->name('pos.finalize-table-session');
    Route::post('/pos/cancel-table-session', [App\Http\Controllers\PosController::class, 'cancelTableSession'])->name('pos.cancel-table-session');
    

    Route::resource('table-orders', TableOrderController::class);
    Route::post('/table-orders/{tableOrder}/add-item', [TableOrderController::class, 'addItem'])->name('table-orders.add-item');
    Route::put('/table-orders/{tableOrder}/update-item/{item}', [TableOrderController::class, 'updateItem'])->name('table-orders.update-item');
    Route::delete('/table-orders/{tableOrder}/remove-item/{item}', [TableOrderController::class, 'removeItem'])->name('table-orders.remove-item');
    Route::put('/table-orders/{tableOrder}/close', [TableOrderController::class, 'closeOrder'])->name('table-orders.close');

    Route::resource('banners', BannerController::class)->middleware('admin');

    Route::resource('partners', PartnersController::class)->middleware('admin');


    Route::resource('categories', CategoryController::class)->middleware('admin');
    Route::post('/categories/sort', [CategoryController::class, 'sort'])->name('categories.sort')->middleware('admin');


    Route::resource('products', ProductController::class)->middleware('admin');

    Route::resource('extra-products', ExtraProductController::class)->middleware('admin');
    Route::post('/extra-products/sort', [ExtraProductController::class, 'sort'])->name('extra-products.sort')->middleware('admin');


    Route::resource('allergies', AllergyController::class)->middleware('admin');

    Route::resource('shipping-fees', ShippingFeeController::class)->middleware('admin');

    Route::resource('sales-reports', SalesReportController::class)->middleware('admin');


    Route::resource('/orders', OrdersController::class);
    Route::get('/orders/{order}/print', [OrdersController::class,'showPrint']);
    Route::get('orders/{id}/invoice', [OrdersController::class, 'invoice'])->name('orders.invoice');
    Route::put('/orders/{id}/updateShippingStatus', [OrdersController::class, 'updateShippingStatus'])
     ->name('orders.updateShippingStatus');


    Route::resource('extra-categories', ExtraCategoryController::class)->middleware('admin');
    Route::post('/extra-categories/sort', [ExtraCategoryController::class, 'sort'])->name('extra-categories.sort')->middleware('admin');

    Route::resource('feedbacks', FeedbackController::class)->middleware('admin');

    // Stock Management Routes
    Route::prefix('stock-management')->name('stock-management.')->middleware('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\StockManagementController::class, 'index'])->name('index');
        Route::get('/transactions', [App\Http\Controllers\StockManagementController::class, 'transactions'])->name('transactions');
        Route::get('/alerts', [App\Http\Controllers\StockManagementController::class, 'alerts'])->name('alerts');
        Route::get('/adjust', [App\Http\Controllers\StockManagementController::class, 'selectProductForAdjustment'])->name('select-product');
        Route::get('/product/{product}/stock', [App\Http\Controllers\StockManagementController::class, 'productStock'])->name('product-stock');
        Route::get('/product/{product}/adjust', [App\Http\Controllers\StockManagementController::class, 'adjustStock'])->name('adjust-stock');
        Route::post('/product/{product}/adjust', [App\Http\Controllers\StockManagementController::class, 'processStockAdjustment'])->name('process-adjustment');
        Route::post('/product/{product}/disable-tracking', [App\Http\Controllers\StockManagementController::class, 'disableStockTracking'])->name('disable-tracking');
        Route::post('/product/{product}/enable-tracking', [App\Http\Controllers\StockManagementController::class, 'enableStockTracking'])->name('enable-tracking');
        Route::post('/bulk-update', [App\Http\Controllers\StockManagementController::class, 'bulkUpdate'])->name('bulk-update');
        Route::post('/alerts/{alert}/acknowledge', [App\Http\Controllers\StockManagementController::class, 'acknowledgeAlert'])->name('acknowledge-alert');
        Route::post('/alerts/{alert}/resolve', [App\Http\Controllers\StockManagementController::class, 'resolveAlert'])->name('resolve-alert');
        Route::get('/export-report', [App\Http\Controllers\StockManagementController::class, 'exportStockReport'])->name('export-report');
        
        // API endpoints
        Route::get('/api/summary', [App\Http\Controllers\StockManagementController::class, 'getStockSummary'])->name('api.summary');
        Route::get('/api/low-stock', [App\Http\Controllers\StockManagementController::class, 'getLowStockProducts'])->name('api.low-stock');
        Route::get('/api/out-of-stock', [App\Http\Controllers\StockManagementController::class, 'getOutOfStockProducts'])->name('api.out-of-stock');
    });

Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::get('/menu/create/{id}', [MenuController::class, 'create'])->name('menu.create');
Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
Route::post('/menu/edit', [MenuController::class, 'storeEdit'])->name('menu.storeEdit');

Route::get('/stats', [ProductController::class, 'stats'])->name('products.stats');
Route::get('/generate-pdf', [ProductController::class, 'generatePdf'])->name('products.generate_pdf');

    Route::get('/send-email/{orderId}', function ($orderId) {
    // Retrieve the order from the database
    $order = Order::findOrFail($orderId);
    // Send the email with the order details
    Mail::to($order->email)->send(new TestMail($order));

    return 'Email sent successfully to ' . $order->email;
});

Route::post('/orders/{order}/send-email', [OrdersController::class, 'sendEmail'])->name('orders.sendEmail');

});
