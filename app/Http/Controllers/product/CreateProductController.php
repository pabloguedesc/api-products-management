<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Services\product\CreateProductService;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
  protected $productService;

  public function __construct(CreateProductService $productService)
  {
    $this->productService = $productService;
  }

  public function store(Request $request)
  {
    $product = $this->productService->createProduct($request);

    return response()->json($product, 201);
  }
}
