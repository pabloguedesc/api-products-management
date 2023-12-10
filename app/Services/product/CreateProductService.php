<?php

namespace App\Services\product;

use App\Exceptions\CustomException;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateProductService
{
  protected $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function createProduct(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:50',
      'description' => 'required|string|max:200',
      'price' => 'required|numeric|min:0',
      'expiry_date' => 'required|date|after_or_equal:today',
      'image' => 'required|string|unique:products,image',
      'category_id' => 'required|uuid|exists:categories,id'
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      throw new CustomException("Falha na validação: " . $errors->first(), 400);
    }

    $validatedData =  $validator->validated();

    return $this->productRepository->create($validatedData);
  }
}
