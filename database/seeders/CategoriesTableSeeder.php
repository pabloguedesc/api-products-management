<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CategoriesTableSeeder extends Seeder
{
  public function run()
  {
    if (DB::table('categories')->count() > 0) {
      echo "Categories seed already run. No new data added.\n";
      return;
    }

    $now = Carbon::now();
    $categoryNames = ['Categoria 1', 'Categoria 2', 'Categoria 3'];
    $categories = [];

    foreach ($categoryNames as $name) {
      $categories[] = [
        'id' => Str::uuid(),
        'name' => $name,
        'created_at' => $now,
        'updated_at' => $now
      ];
    }

    DB::table('categories')->insert($categories);
  }
}
