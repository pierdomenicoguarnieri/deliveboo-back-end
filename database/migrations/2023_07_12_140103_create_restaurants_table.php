<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('restaurants', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('slug');
      $table->string('email');
      $table->double('rating', 2, 1)->nullable();
      $table->string('address');
      $table->string('piva', 11);
      $table->string('telephone_number');
      $table->string('image_path')->nullable();
      $table->string('image_name')->nullable();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('restaurants');
  }
};
