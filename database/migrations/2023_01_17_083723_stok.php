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
        Schema::create('stok', function (Blueprint $table) {
            $table->id('stok_id');
            $table->foreignId('produk_id');
            $table->string('jumlah');
            $table->string('harga_beli');
            $table->string('harga_jual');
            $table->date('tgl_masuk');
            $table->timestamps();
            $table->foreign('produk_id')->references('produk_id')->on('produk')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stok');
    }
};
