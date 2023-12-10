<?php

namespace App\Services\category;

use App\Repositories\CategoryRepository;

class ListAllCategoriesService
{
  protected $categoryRepository;

  public function __construct(CategoryRepository $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function ListAllCategories()
  {
    return $this->categoryRepository->getAll();
  }
}
