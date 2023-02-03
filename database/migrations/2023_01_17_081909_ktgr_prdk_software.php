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
        Schema::create('ktgr_prdk_software', function (Blueprint $table) {
            $table->id('ktgr_prosoft_id');
            $table->foreignId('ktgr_id');
            $table->string('jenis_prosoft', 50);
            $table->string('foto_prosoft', 30);
            $table->longText('des_ktgrprosoft');
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
        Schema::drop('ktgr_prdk_software');
    }
};
