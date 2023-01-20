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

            $table->foreignId('produk_id');
            $table->foreignId('sablon_id');
            $table->foreignId('kurir_id');

            $table->enum('status_pesanan', ['masuk', 'kemas', 'kirim', 'diterima'])->default('masuk');
            $table->date('tgl_checkout');
            $table->timestamps();
            $table->foreign('produk_id')->references('produk_id')->on('produk')->cascadeOnUpdate()->cascadeOnDelete();
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
