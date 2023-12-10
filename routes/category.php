<?php

use App\Http\Controllers\category\ListAllCategoriesController;
use Illuminate\Support\Facades\Route;

Route::prefix('category')->group(function () {
  Route::get('/', [ListAllCategoriesController::class, 'getAll']);
});
