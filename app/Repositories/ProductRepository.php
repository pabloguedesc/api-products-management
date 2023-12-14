<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
  public function create(array $data): Product
  {
    return Product::create($data);
  }

  public function findProductById(string $id): ?Product
  {
    return Product::find($id);
  }

  public function update(Product $product, array $data): ?Product
  {
    $product->update($data);
    return $product;
  }

  public function delete(Product $product): bool
  {
    return $product->delete();
  }

  public function getAll(int $take = 10, string $item = 'name', string $filterValue = '', int $page = 1): \Illuminate\Contracts\Pagination\LengthAwarePaginator
  {
      $query = Product::query();

      if (!empty($filterValue)) {
          $query->where($item, 'like', '%' . $filterValue . '%');
      }

      return $query->paginate($take, ['*'], 'page', $page);
  }
}
