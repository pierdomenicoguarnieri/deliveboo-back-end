<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Restaurant;
use App\Models\Dish;
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

        $dishes = Dish::all();
        $array_id = [];
        foreach($dishes as $dish){
            array_push($array_id, $dish['id']);
        }

        foreach($restaurants as $restaurant){

            $new_restaurant = new Restaurant();
            
            //$random_id = $faker->randomNumber(1, count($array_id));

            //$new_restaurant->dish_id->attach($random_id);
            //dd($new_restaurant);
            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->slug = Str::slug($restaurant['name'], '-');
            $new_restaurant->piva = $faker->numberBetween(10000000000, 99999999999);
            $new_restaurant->email = $restaurant['email'];
            $new_restaurant->telephone_number = $restaurant['telephone-number'];
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->image_path = $restaurant['image-path'];
            $new_restaurant->image_name = $restaurant['image-name'];
            $new_restaurant->rating = $faker->randomFloat(1, 1, 5);
            $new_restaurant->save();
        }
    }
}
