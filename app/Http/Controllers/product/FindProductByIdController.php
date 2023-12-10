<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Services\product\FindProductByIdService;
use Illuminate\Http\Request;

class FindProductByIdController extends Controller
{
  protected $productService;

  public function __construct(FindProductByIdService $productService)
  {
    $this->productService = $productService;
  }
  public function findOne(Request $request)
  {
    return $this->productService->findProductById($request->id);
  }
}
