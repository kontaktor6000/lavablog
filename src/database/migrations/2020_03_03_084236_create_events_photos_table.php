<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photo');
            $table->bigInteger('event_id')->unsigned();
            $table->timestamps();

            $table->foreign('event_id')->references('id')
                                                ->on('events')
                                                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_photos');
    }
}
