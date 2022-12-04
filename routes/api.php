<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   return $request->user();
});

//untuk public
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/category', [CategoryController::class, 'index']);

Route::middleware('auth:sanctum')->group(function (){
  Route::post('/logout', [AuthController::class,'logout']);
  
  Route::middleware('admin')->group(function (){
   //untuk produk
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
  // untuk kategori
  Route::post('/category', [categoryController::class, 'store']);
    Route::put('/category/{id}', [CategoryController::class, 'update']);
    
  });

});
Route::resource('transaction', TransactionController::class);


