<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latihan', function (Blueprint $table) {
            $table->string('kode_latihan', 20)->primary();
            $table->string('nm_latihan');
            $table->integer('id_kelas');
            $table->bigInteger('id_guru');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('latihan');
    }
}
