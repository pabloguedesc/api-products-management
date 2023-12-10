<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Services\category\ListAllCategoriesService;

class ListAllCategoriesController extends Controller
{
  protected $categoryService;

  public function __construct(ListAllCategoriesService $categoryService)
  {
    $this->categoryService = $categoryService;
  }

  public function getAll()
  {
    $categories = $this->categoryService->ListAllCategories();

    return response()->json($categories, 200);
  }
}
