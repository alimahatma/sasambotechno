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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('produk_id');

            $table->foreignId('ktgr_id');
            $table->foreignId('stok_id');
            $table->foreignId('supplier_id');

            $table->string('nama_produk', 35);
            $table->string('foto_dep', 30);
            $table->string('foto_bel', 30);
            $table->longText('deskripsi');
            $table->string('satuan', 10);
            $table->string('size', 10);
            $table->timestamps();
            $table->foreign('ktgr_id')->references('ktgr_id')->on('ktgr_produk')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('stok_id')->references('stok_id')->on('stok')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('supplier_id')->references('supplier_id')->on('supplier')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produk');
    }
};
