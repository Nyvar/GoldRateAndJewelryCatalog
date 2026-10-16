<?php 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



//route for product Controller
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products',[ProductController::class,'store']);
Route::put('/products/{id}',[ProductController::class,'update']);
Route::delete('/products/{id}',[ProductController::class,'destroy']);



//route for user controller 
Route::get('/register', [AuthController::class,'register']);
Route::get('/login', [AuthController::class,'login']);


//route for fqa controller
Route::get('/ask', [FaqController::class,'ask']);


//route for message controller
