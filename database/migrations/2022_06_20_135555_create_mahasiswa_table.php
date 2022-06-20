<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('fakultas_id')->nullable();
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->unsignedBigInteger('prov_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('dis_id')->nullable();
            $table->unsignedBigInteger('subdis_id')->nullable();
            $table->string('Rt')->nullable();

            $table->foreign('status_id')->references('id')->on('status')->onDelete(NULL);
            $table->foreign('fakultas_id')->references('id')->on('fakultas')->onDelete(NULL);
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete(NULL);
            // $table->foreign('province_id')->references('prov_id')->on('provinces')->onDelete(NULL);
            // $table->foreign('city_id')->references('city_id')->on('cities')->onDelete(NULL);
            // $table->foreign('district_id')->references('dis_id')->on('districts')->onDelete(NULL);
            // $table->foreign('subdistrict_id')->references('subdis_id')->on('subdistricts')->onDelete(NULL);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
