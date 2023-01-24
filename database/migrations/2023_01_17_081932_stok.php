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

            $table->foreignId('warna_id');

            $table->integer('jumlah');
            $table->string('jenis_kain', 25);
            $table->decimal('harga_beli');
            $table->decimal('harga_jual');
            $table->date('tgl_masuk');
            $table->timestamps();
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
        Schema::drop('stok');
    }
};
