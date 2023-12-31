<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('dishes', function (Blueprint $table) {
      $table->unsignedBigInteger('restaurant_id')->after('id')->nullable();
      $table->foreign('restaurant_id')
        ->references('id')
        ->on('restaurants')
        ->cascadeOnDelete();
    });
  }

  public function down()
  {
    Schema::table('dishes', function (Blueprint $table) {
      $table->dropForeign(['restaurant_id']);
      $table->dropColumn('restaurant_id');
    });
  }
};
