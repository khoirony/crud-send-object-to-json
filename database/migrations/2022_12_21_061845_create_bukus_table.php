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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku', 255);
            $table->year('tahun_terbit');
            $table->string('penerbit_buku', 255);
            $table->integer('jumlah_halaman');
            $table->text('sinopsis_buku')->nullable();
            $table->string('gambar_cover')->nullable();
            $table->integer('id_kategori');
            $table->integer('id_author');
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
        Schema::dropIfExists('bukus');
    }
};
