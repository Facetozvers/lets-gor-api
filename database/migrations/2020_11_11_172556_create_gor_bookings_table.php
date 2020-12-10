<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGorBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gor_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi')->nullable();
            $table->bigInteger('id_gor')->unsigned();
            $table->foreign('id_gor')->references('id')->on('gors');
            $table->bigInteger('id_pemilik')->unsigned();
            $table->foreign('id_pemilik')->references('id')->on('users');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->time('start_hour');
            $table->time('finish_hour');
            $table->integer('total');
            $table->string('status'); //lunas, belum lunas
            $table->string('approval'); //approved, pending, declined
            $table->longText('message');
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
        Schema::dropIfExists('gor_bookings');
    }
}
