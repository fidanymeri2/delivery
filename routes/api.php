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
MenuController

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
