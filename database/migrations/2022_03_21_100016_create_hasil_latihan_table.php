<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilLatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_latihan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_siswa');
            $table->string('id_latihan', 20);
            $table->text('jawaban');
            $table->double('nilai', 5, 2);
            $table->timestamps();

            $table->foreign('id_siswa')->references('nis')->on('siswa')->onDelete('cascade');
            $table->foreign('id_latihan')->references('kode_latihan')->on('latihan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_latihan');
    }
}
