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
        Schema::create('instansi', function (Blueprint $table) {
            $table->id('inst_id');
            $table->string('nama_instansi');
            $table->string('logo', 30);
            $table->string('visi', 100);
            $table->string('misi', 200);
            $table->longText('tentang', 200);
            $table->string('alamat', 255);
            $table->string('domain', 30);
            $table->string('email', 30);
            $table->string('whatsapp', 12);
            $table->string('instagram', 30);
            $table->string('facebook', 30);
            $table->string('billing', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('instansi');
    }
};
