<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pemilik')->unsigned();
            $table->foreign('id_pemilik')->references('id')->on('users');
            $table->bigInteger('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id')->on('categories');
            $table->string('nama');
            $table->longText('desc');
            $table->string('telp')->unique();
            $table->string('imgUrl')->nullable();
            $table->string('kota');
            $table->string('alamat_lengkap');
            $table->integer('harga_per_jam');
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
        Schema::dropIfExists('gors');
    }
}
