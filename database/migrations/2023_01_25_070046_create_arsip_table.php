<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsip', function (Blueprint $table) {
            $table->id();
            $table->string('kode_klasifikasi');
            $table->string('jenis_arsip');
            $table->string('deskripsi')->unique();
            $table->integer('tahun');
            $table->string('tingkat_perkembangan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('lokasi_depot')->nullable();
            $table->string('lokasi_rak')->nullable();
            $table->integer('no_box')->nullable();
            $table->integer('no_folder')->nullable();
            $table->string('jangka_simpan')->nullable();
            $table->string('kategori_arsip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip');
    }
};
