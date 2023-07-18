<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('dishes', function(Blueprint $table)
    {
      $table->timestamp('deleted_at')->nullable();
    });
  }

  public function down()
  {
    Schema::table('dishes', function(Blueprint $table)
    {
      $table->dropColumn('deleted_at');
    });
  }
};
