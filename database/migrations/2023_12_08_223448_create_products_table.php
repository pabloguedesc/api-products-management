<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('products', function (Blueprint $table) {
      $table->uuid('id')->primary(); // Define 'id' como UUID e chave primária
      $table->string('name', 50);
      $table->string('description', 200);
      $table->double('price')->unsigned();
      $table->date('expiry_date');
      $table->string('image')->unique();

      // Modifica 'category_id' para ser UUID e referenciar a tabela 'categories'
      $table->uuid('category_id');
      $table->foreign('category_id')->references('id')->on('categories');

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};
