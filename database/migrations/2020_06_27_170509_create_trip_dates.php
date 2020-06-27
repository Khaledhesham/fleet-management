<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_dates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('trip_id');
            $table->text('day');
            $table->tinyInteger('weekday');
            $table->time('time');
            $table->boolean('is_recurring');
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
        Schema::dropIfExists('trip_dates');
    }
}
