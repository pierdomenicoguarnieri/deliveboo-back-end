<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = config('dishes');

        foreach ($dishes as $dish) {
            $new_dish = new Dish();
            $new_dish->name = $dish['name'];
            $new_dish->price = $dish['price'];
            $new_dish->visible = $dish['visible'];
            $new_dish->description = $dish['description'];
            $new_dish->ingredients = $dish['ingredients'];
            $new_dish->is_vegan = $dish['is_vegan'];
            $new_dish->is_frozen = $dish['is_frozen'];
            $new_dish->is_gluten_free = $dish['is_gluten_free'];
            $new_dish->is_lactose_free = $dish['is_lactose_free'];
            $new_dish->type = $dish['type'];
            $new_dish->save();
        }
    }
}
