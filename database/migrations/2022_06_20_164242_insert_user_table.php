<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InsertUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $faker = Faker::create('id_ID');

        $superadmin = User::create([
            'name' => $faker->name,
            'email' => 'superadmin@gmail',
            'password' => Hash::make('secret123'),
        ]);
        $dosen = User::create([
            'name' => $faker->name,
            'email' => 'dosen@gmail',
            'password' => Hash::make('secret123'),
        ]);
        $mahasiswa = User::create([
            'name' => $faker->name,
            'email' => 'mahasiswa@gmail',
            'password' => Hash::make('secret123'),
        ]);

        // $superadminRole = Role::findByName(\App\Laravue\Acl::ROLE_PENGAWAS);
        // $dosenRole = Role::findByName(\App\Laravue\Acl::ROLE_PENGAWAS);
        // $mahasiswaRole = Role::findByName(\App\Laravue\Acl::ROLE_PENGAWAS);


        // $superadmin->syncRoles($superadminRole);
        // $dosen->syncRoles($dosenRole);
        // $mahasiswa->syncRoles($mahasiswaRole);
    }
}
