<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->string('kode_materi', 20)->primary();
            $table->string('nm_materi');
            $table->integer('id_kelas');
            $table->bigInteger('id_guru');
            $table->integer('bab');
            $table->string('file_materi');
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('id_kelas')->references('kode_kelas')->on('kelas');
            $table->foreign('id_guru')->references('nip')->on('guru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materi');
    }
}
