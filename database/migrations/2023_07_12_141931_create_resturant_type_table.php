<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('resturant_type', function (Blueprint $table) {
      $table->unsignedBigInteger('resturant_id');
      $table->foreign('resturant_id')
        ->references('id')
        ->on('resturants')
        ->cascadeOnDelete();

      $table->unsignedBigInteger('type_id');
      $table->foreign('type_id')
        ->references('id')
        ->on('types')
        ->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('resturant_type');
  }
};
