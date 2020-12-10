<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGorSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gor_schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_gor')->unsigned();
            $table->foreign('id_gor')->references('id')->on('gors');
            $table->string('hari');
            $table->time('open_hour');
            $table->time('close_hour');
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
        Schema::dropIfExists('gor_schedules');
    }
}
