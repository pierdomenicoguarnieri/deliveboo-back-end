<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Restaurant;
use Faker\Generator as Faker;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants = config('restaurants');

        foreach($restaurants as $restaurant){

            $new_restaurant = new Restaurant();

            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->slug = Str::slug($restaurant['name'], '-');
            $new_restaurant->name = $faker->numberBetween(10000000000, 99999999999);
            $new_restaurant->email = $restaurant['email'];
            $new_restaurant->telephone_number = $restaurant['telephone-number'];
            $new_restaurant->name = $restaurant['address'];
            $new_restaurant->image_path = $restaurant['image-path'];
            $new_restaurant->image_name = $restaurant['image-name'];
            $new_restaurant->name = $faker->randomFloat(1, 0, 5);
            $new_restaurant->save();
        }
    }
}
