<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_barang');
            $table->string('gambar')->nullable();
            $table->string('keterangan');
            $table->integer('jumlah_rusak')->nullable();
            $table->unsignedBigInteger('ruang_id');
            $table->foreign('ruang_id')->references('id')->on('ruangs')->onDelete('cascade');
            $table->timestamps();
        });

        Schema:: create('barang_merk', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->unsignedBigInteger('merk_id');
            $table->foreign('merk_id')->references('id')->on('merks')->onDelete('cascade');
            $table->primary(['barang_id','merk_id']);
            $table->string('jumlah');
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
        Schema::dropIfExists('barangs');
        Schema::dropIfExists('barang_merk');
    }
}
