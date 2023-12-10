<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Services\product\DeleteProductService;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{
  protected $productService;

  public function __construct(DeleteProductService $productService)
  {
    $this->productService = $productService;
  }

  public function delete(Request $request)
  {
    return $this->productService->deleteProduct($request->id);
  }
}
