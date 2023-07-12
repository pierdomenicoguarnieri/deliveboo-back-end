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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price',5,2);
            $table->boolean('visible')->default(false);
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->boolean('is_vegan')->default(false);
            $table->boolean('is_frozen')->default(false);
            $table->boolean('is_gluten_free')->default(false);
            $table->boolean('is_lactose_free')->default(false);
            $table->string('type', 50)->nullable();
            $table->string('image_path')->nullable();
            $table->string('image_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
};
