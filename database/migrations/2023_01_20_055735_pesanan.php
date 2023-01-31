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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('pesanan_id');
            $table->foreignId('procus_id');
            $table->foreignId('member_id');
            $table->foreignId('sablon_id');
            $table->foreignId('kurir_id');
            $table->integer('jml_order')->length(10)->unsigned();
            $table->date('tgl_order');
            $table->enum('stts_produksi', ['diterima', 'produksi', 'packing', 'kasir'])->default('diterima');
            $table->enum('status_pesanan', ['pending', 'diterima', 'kirim', 'selesai'])->default('pending');
            $table->timestamps();
            $table->foreign('procus_id')->references('procus_id')->on('produk_custom')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('member_id')->references('member_id')->on('member')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('sablon_id')->references('sablon_id')->on('sablon')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('kurir_id')->references('kurir_id')->on('kurir')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pesanan');
    }
};
