<?php

use App\Http\Controllers\product\CreateProductController;
use App\Http\Controllers\product\DeleteProductController;
use App\Http\Controllers\product\FindProductByIdController;
use App\Http\Controllers\product\ListAllProductsController;
use App\Http\Controllers\product\UpdateProductController;
use App\Http\Controllers\product\UploadImageController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
  // public routes
  Route::get('/', [ListAllProductsController::class, 'getAllProducts']);
  Route::get('/{id}', [FindProductByIdController::class, 'findOne']);
  Route::post('/upload-image', [UploadImageController::class, 'uploadImage'])->name('image.upload');

  // private routes
  Route::middleware('jwt.verify')->group(function () {
    Route::post('/', [CreateProductController::class, 'store']);
    Route::put('/{id}', [UpdateProductController::class, 'update']);
    Route::delete('/{id}', [DeleteProductController::class, 'delete']);
  });
});
