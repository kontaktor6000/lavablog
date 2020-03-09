<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name')->unique();
            $table->date('begin_date');
            $table->date('end_date');
            $table->time('begin_time');
            $table->time('end_time');
            $table->string('event_image_preview')->nullable();
            $table->bigInteger('country_id');
            $table->float('basic_cost' )->unsigned();
            $table->float('vip_cost' )->unsigned();
            $table->string('event_place');
            $table->text('event_basic_description')->nullable();
            $table->text('event_vip_description')->nullable();
            $table->bigInteger('woman_basic_member');
            $table->bigInteger('man_basic_member');
            $table->bigInteger('woman_vip_member');
            $table->bigInteger('man_vip_member');
            $table->string('event_video')->nullable();

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
        Schema::dropIfExists('events');
    }
}
