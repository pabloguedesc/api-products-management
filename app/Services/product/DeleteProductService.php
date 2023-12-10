<?php

namespace App\Services\product;

use App\Exceptions\CustomException;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeleteProductService
{
  protected $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function deleteProduct(string $id): bool
  {
    $product = $this->productRepository->findProductById($id);

    if (!$product) {
      throw new CustomException("Produto não encontrado", 404);
    }

    return $this->productRepository->delete($product);
  }
}
