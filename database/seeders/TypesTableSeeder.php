<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config('types');

        foreach ($types as $type) {
            DB::table('types')->insert([
                'name' => $type['name']
            ]);
        }
    }
}