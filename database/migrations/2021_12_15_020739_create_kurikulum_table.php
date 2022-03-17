<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKurikulumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->string('kode_kurikulum', 20)->primary();
            $table->string('id_materi', 20);
            $table->integer('id_kelas');
            $table->string('file_kurikulum');
            $table->string('kurikulum_path');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_kelas')->references('kode_kelas')->on('kelas');
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
        Schema::dropIfExists('kurikulum');
    }
}
