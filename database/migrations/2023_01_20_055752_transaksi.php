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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('transaksi_id');
            $table->foreignId('member_id');
            $table->foreignId('produk_id');
            $table->foreignId('sablon_id');
            $table->date('tangal_transaksi');
            $table->foreign('member_id')->references('member_id')->on('member')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('produk_id')->references('produk_id')->on('produk')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('sablon_id')->references('sablon_id')->on('sablon')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaksi');
    }
};
