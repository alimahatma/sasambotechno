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
        Schema::create('member', function (Blueprint $table) {
            $table->id('member_id');
            $table->foreignId('user_id');
            $table->string('nama_lengkap', 30);
            $table->string('telepon', 14);
            $table->enum('gender', ['L', 'P']);
            $table->string('desa', 30);
            $table->string('kecamatan', 30);
            $table->string('kabupaten', 30);
            $table->string('provinsi', 35);
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member');
    }
};
