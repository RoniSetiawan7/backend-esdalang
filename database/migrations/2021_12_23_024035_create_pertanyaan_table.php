<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertanyaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('soal');
            $table->text('jawaban_benar');
            $table->text('jawaban_salah_1');
            $table->text('jawaban_salah_2');
            $table->text('jawaban_salah_3');
            $table->string('ket_gambar')->nullable();
            $table->string('image_path')->nullable();
            $table->string('id_latihan', 20);
            $table->string('id_materi', 20);
            $table->timestamps();

            $table->foreign('id_latihan')->references('kode_latihan')->on('latihan')->onDelete('cascade');
            $table->foreign('id_materi')->references('kode_materi')->on('materi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertanyaan');
    }
}
