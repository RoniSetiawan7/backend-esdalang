<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigInteger('nis')->primary();
            $table->string('nm_siswa');
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('id_kelas', 5)->nullable();
            $table->string('sub_kelas', 5)->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // $table->foreign('id_kelas')->references('kode_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
