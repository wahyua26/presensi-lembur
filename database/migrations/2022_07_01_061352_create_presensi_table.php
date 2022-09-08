<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_npp');
            $table->string('tugas')->nullable();
            $table->date('tgl');
            $table->time('jamMasuk');
            $table->string('fotoMasuk');
            $table->string('latMasuk');
            $table->string('longMasuk');
            $table->time('jamKeluar')->nullable();
            $table->string('fotoKeluar')->nullable();
            $table->string('latKeluar')->nullable();
            $table->string('longKeluar')->nullable();
            $table->time('lamaLembur')->nullable();
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
        Schema::dropIfExists('presensi');
    }
}
