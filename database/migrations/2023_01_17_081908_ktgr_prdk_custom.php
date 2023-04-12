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
        Schema::create('ktgr_prdk_custom', function (Blueprint $table) {
            $table->id('ktgr_procus_id');
            $table->foreignId('ktgr_id');
            $table->string('jenis_procus', 50);
            $table->string('foto_procus', 30);
            $table->longText('deskripsi_kategori_produk_custom');
            $table->timestamps();
            $table->foreign('ktgr_id')->references('ktgr_id')->on('ktgr_produk')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ktgr_prdk_custom');
    }
};
