<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = User::all();
      foreach ($users as $key => $user) {
        $user->restaurant_id = Restaurant::where('id', $key + 1)->first()->id;
        $user->update();
      }
    }
}
