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
            $table->foreignId('user_id');
            $table->foreignId('sablon_id');
            $table->foreignId('kurir_id');
            $table->foreignId('payment_id');
            $table->string('color', 20);
            $table->string('size_order', 10);
            $table->integer('jml_order')->length(10)->unsigned();
            $table->double('jml_dp')->nullable();
            $table->double('jml_lunas')->nullable();
            $table->double('all_total')->nullable();
            $table->string('b_dp', 30)->nullable();
            $table->string('b_lunas', 30)->nullable();
            $table->string('t_pesan', 150);
            $table->date('tgl_order');
            $table->enum('pay_status', ['pending', 'bayar', 'belum lunas', 'lunas'])->default('belum lunas');
            $table->enum('stts_produksi', ['pending', 'produksi', 'packing', 'selesai'])->default('pending');
            $table->enum('status_pesanan', ['pending', 'diterima', 'kirim', 'selesai'])->default('pending');
            $table->timestamps();
            $table->foreign('procus_id')->references('procus_id')->on('produk_custom')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('sablon_id')->references('sablon_id')->on('sablon')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('kurir_id')->references('kurir_id')->on('kurir')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('payment_id')->references('payment_id')->on('payment')->cascadeOnUpdate()->cascadeOnDelete();
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
