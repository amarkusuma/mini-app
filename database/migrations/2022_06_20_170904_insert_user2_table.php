<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class InsertUser2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $faker = Faker::create('id_ID');

        $superadmin = User::create([
            'name' => $faker->name,
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('secret123'),
        ]);
        $dosen = User::create([
            'name' => $faker->name,
            'email' => 'dosen@gmail.com',
            'username' => 'dosen',
            'password' => Hash::make('secret123'),
        ]);
        $mahasiswa = User::create([
            'name' => $faker->name,
            'email' => 'mahasiswa@gmail',
            'username' => 'mahasiswa',
            'password' => Hash::make('secret123'),
        ]);

        $superadminRole = Role::findByName('superadmin');
        $dosenRole = Role::findByName('dosen');
        $mahasiswaRole = Role::findByName('mahasiswa');


        $superadmin->syncRoles($superadminRole);
        $dosen->syncRoles($dosenRole);
        $mahasiswa->syncRoles($mahasiswaRole);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
