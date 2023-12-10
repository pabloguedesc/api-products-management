<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Services\product\ListAllProductsService;
use Illuminate\Http\Request;

class ListAllProductsController extends Controller
{
  protected $productService;

  public function __construct(ListAllProductsService $productService)
  {
    $this->productService = $productService;
  }

  public function getAllProducts(Request $request)
  {
    try {
      $products = $this->productService->getAllProducts($request);
      return response()->json($products);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }
}
