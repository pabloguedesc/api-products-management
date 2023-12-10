<?php

namespace App\Services\product;

use App\Exceptions\CustomException;
use App\Models\Product;
use App\Repositories\ProductRepository;

class FindProductByIdService
{
  protected $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function findProductById(string $id): Product
  {
    $product = $this->productRepository->findProductById($id);
    return $product ?? throw new CustomException("Produto não encontrado", 404);
  }
}
