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
        Schema::create('trx_sablon', function (Blueprint $table) {
            $table->id('trx_sablon_id');
            $table->foreignId('member_id');
            $table->foreignId('sablon_id');
            $table->foreignId('kurir_id');
            $table->integer('jml')->length(10)->unsigned();
            $table->enum('stts_produksi', ['diterima', 'produksi', 'packing', 'kasir'])->default('diterima');
            $table->enum('trx_status', ['pending', 'diterima', 'kirim', 'selesai'])->default('pending');
            $table->timestamps();
            $table->foreign('member_id')->references('member_id')->on('member')->cascadeOnupdate()->cascadeOnDelete();
            $table->foreign('sablon_id')->references('sablon_id')->on('sablon')->cascadeOnupdate()->cascadeOnDelete();
            $table->foreign('kurir_id')->references('kurir_id')->on('kurir')->cascadeOnupdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trx_sablon');
    }
};
