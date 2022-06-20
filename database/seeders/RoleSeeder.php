<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert([
            'name' => 'superadmin',
            'guard_name' => 'api',
        ]);

        \DB::table('roles')->insert([
            'name' => 'superadmin',
            'guard_name' => 'web',
        ]);
        \DB::table('roles')->insert([
            'name' => 'mahasiswa',
            'guard_name' => 'api',
        ]);

        \DB::table('roles')->insert([
            'name' => 'mahasiswa',
            'guard_name' => 'web',
        ]);
        \DB::table('roles')->insert([
            'name' => 'dosen',
            'guard_name' => 'api',
        ]);

        \DB::table('roles')->insert([
            'name' => 'dosen',
            'guard_name' => 'web',
        ]);
    }
}
