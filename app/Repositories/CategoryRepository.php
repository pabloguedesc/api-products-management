<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
  /**
   * Create a new category.
   *
   * @param array $data
   * @return Category
   */
  public function create(array $data): Category
  {
    return Category::create($data);
  }

  /**
   * Find a category by its ID.
   *
   * @param string $id
   * @return Category|null
   */
  public function findCategoryById(string $id): ?Category
  {
    return Category::find($id);
  }
  public function findCategoryByName(string $name): ?Category
  {
    return Category::where('name', $name)->first();
  }

  /**
   * Update a category.
   *
   * @param string $id
   * @param array $data
   * @return Category|null
   */
  public function update(string $id, array $data): ?Category
  {
    $category = $this->findCategoryById($id);
    if ($category) {
      $category->update($data);
    }
    return $category;
  }

  /**
   * Delete a category.
   *
   * @param string $id
   * @return bool
   */
  public function delete(string $id): bool
  {
    $category = $this->findCategoryById($id);
    if ($category) {
      return $category->delete();
    }
    return false;
  }

  /**
   * Get all categories.
   *
   * @return \Illuminate\Database\Eloquent\Collection|Category[]
   */
  public function getAll(): \Illuminate\Database\Eloquent\Collection
  {
    return Category::all();
  }
}
