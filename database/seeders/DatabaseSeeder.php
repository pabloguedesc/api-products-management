<?php

use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\UserMasterSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call(CategoriesTableSeeder::class);
    $this->call(UserMasterSeeder::class);
  }
}
