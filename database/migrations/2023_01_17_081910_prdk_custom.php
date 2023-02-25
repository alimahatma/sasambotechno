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
        Schema::create('produk_custom', function (Blueprint $table) {
            $table->id('procus_id');
            $table->foreignId('supplier_id');
            $table->foreignId('ktgr_procus_id');
            $table->foreignId('warna_id');
            $table->string('nama_produk', 35);
            $table->string('foto_dep', 30);
            $table->string('foto_bel', 30);
            $table->string('satuan', 10);
            $table->string('jenis_kain', 25);
            $table->string('size', 10);
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->date('tgl_masuk');
            $table->longText('deskripsi');
            $table->timestamps();
            $table->foreign('supplier_id')->references('supplier_id')->on('supplier')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('ktgr_procus_id')->references('ktgr_procus_id')->on('ktgr_prdk_custom')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('warna_id')->references('warna_id')->on('warna')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produk_custom');
    }
};
