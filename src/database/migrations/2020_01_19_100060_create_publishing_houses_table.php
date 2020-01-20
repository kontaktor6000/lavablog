<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishingHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishing_houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('owner_id')->unsigned();
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('cities');

            $table->foreign('owner_id')
                ->references('id')
                ->on('owners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publishing_houses');
    }
}
