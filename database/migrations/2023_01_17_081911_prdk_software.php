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
        Schema::create('prdk_software', function (Blueprint $table) {
            $table->id('prosoft_id');
            $table->foreignId('ktgr_id');
            $table->foreignId('ktgr_prosoft_id');
            $table->string('jenis_software', 30);
            $table->string('foto_prosoft', 30);
            $table->longText('deskripsi_prosoft');
            $table->timestamps();
            $table->foreign('ktgr_id')->references('ktgr_id')->on('ktgr_produk')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('ktgr_prosoft_id')->references('ktgr_prosoft_id')->on('ktgr_prdk_software')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prdk_software');
    }
};
