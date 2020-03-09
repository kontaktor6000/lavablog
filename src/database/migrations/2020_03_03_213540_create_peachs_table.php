<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peachs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('informer_id')->unsigned();
            $table->bigInteger('violator_id')->unsigned();
            $table->string('shot_peach', 100);
            $table->text('full_peach');
            $table->timestamps();

            //$table->primary(['informer_id', 'violator_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peachs');
    }
}
