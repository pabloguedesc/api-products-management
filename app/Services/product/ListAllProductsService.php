<?php

namespace App\Services\product;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListAllProductsService
{
  protected $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function getAllProducts(Request $request)
  {
    $validatedData = Validator::make($request->all(), [
      'take' => 'sometimes|integer|min:1',
      'item' => 'required|in:name,description',
      'filterValue' => 'sometimes',
      'page' => 'sometimes|integer'
    ])->validate();

    $take = $validatedData['take'] ?? 10;
    $item = $validatedData['item'];
    $filterValue = $validatedData['filterValue'] ?? '';
    $page = $validatedData['page'] ?? '';

    return $this->productRepository->getAll($take, $item, $filterValue, $page);
  }
}
