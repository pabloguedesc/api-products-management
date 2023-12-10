<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserMasterSeeder extends Seeder
{
  public function run()
  {
    if (DB::table('users')->where('email', 'master@example.com')->exists()) {
      echo "Master user already exists. No new data added.\n";
      return;
    }

    DB::table('users')->insert([
      'name' => 'Master User',
      'email' => 'master@example.com',
      'password' => Hash::make('masterpassword'),
    ]);
  }
}
