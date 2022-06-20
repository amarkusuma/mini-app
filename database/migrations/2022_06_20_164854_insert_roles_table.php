<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertRolesTable extends Migration
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
