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
        Schema::create('cart_shop', function (Blueprint $table) {
            $table->id('cart_id');
            $table->foreignId('user_id');
            $table->foreignId('procus_id')->nullable();
            $table->foreignId('warna_id')->nullable();
            $table->foreignId('sablon_id')->nullable();
            $table->integer('jumlah_order')->length(10)->unsigned();
            $table->double('harga_satuan');
            $table->double('harga_totals');
            $table->longText('tinggalkanpesan');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('procus_id')->references('procus_id')->on('produk_custom')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('warna_id')->references('warna_id')->on('warna')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::drop('cart_shop');
    }
};
