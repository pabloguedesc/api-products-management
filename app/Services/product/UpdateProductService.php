<?php

namespace App\Services\product;

use App\Exceptions\CustomException;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateProductService
{
  protected $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function updateProduct(string $id, Request $request): ?Product
  {
    $validator = Validator::make($request->all(), [
      'name' => 'sometimes|string|max:50',
      'description' => 'sometimes|string|max:200',
      'price' => 'sometimes|numeric|min:0',
      'expiry_date' => 'sometimes|date|after_or_equal:today',
      'image' => 'sometimes',
      'category_id' => 'sometimes|uuid|exists:categories,id'
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      throw new CustomException("Falha na validação: " . $errors->first(), 400);
    }

    $validatedData =  $validator->validated();

    $product = $this->productRepository->findProductById($id);

    if (!$product) {
      throw new CustomException("Produto não encontrado", 404);
    }

    return $this->productRepository->update($product, $validatedData);
  }
}
