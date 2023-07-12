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
    Schema::table('restaurants', function (Blueprint $table) {
      $table->unsignedBigInteger('dish_id')->after('id')->nullable();
      $table->foreign('dish_id')
        ->references('id')
        ->on('dishes')
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
    Schema::table('restaurants', function (Blueprint $table) {
      $table->dropForeign(['dish_id']);
      $table->dropColumn('dish_id');
    });
  }
};
