<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Type;

class RestaurantsTypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $restaurants = Restaurant::all();
    foreach ($restaurants as $restaurant) {
      $type = Type::inRandomOrder()->limit(rand(1, 3))->pluck('id');
      $restaurant->types()->attach($type);
    }
  }
}
