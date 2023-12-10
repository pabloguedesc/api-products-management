<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Services\product\UpdateProductService;
use Illuminate\Http\Request;

class UpdateProductController extends Controller
{
  protected $productService;

  public function __construct(UpdateProductService $productService)
  {
    $this->productService = $productService;
  }

  public function update(Request $request, $id)
  {
    $product = $this->productService->updateProduct($id, $request);
    return response()->json($product, 200);
  }
}
