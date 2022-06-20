<?php

namespace Database\Seeders;

use App\Models\FakultasModel;
use App\Models\JurusanModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
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
    		DB::table('dosen')->insert([
    			'name' => $faker->name,
                'status_id' => $faker->numberBetween(1,2),
    			'address' => $faker->address
    		]);
    	}
    }
}
