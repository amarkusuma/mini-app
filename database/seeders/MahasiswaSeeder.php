<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 30; $i++){

    		DB::table('mahasiswa')->insert([
    			'name' => $faker->name,
                'status_id' => $faker->numberBetween(1,2),
    			'address' => $faker->address
    		]);

    	}
    }
}
