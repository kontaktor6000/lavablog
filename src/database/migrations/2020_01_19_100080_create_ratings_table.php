<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->unsigned();
            $table->bigInteger('reader_id')->unsigned();
            $table->bigInteger('assessment')->unsigned();
            $table->timestamps();

            $table->foreign('book_id')
                ->references('id')
                ->on('books');
            $table->foreign('reader_id')
                ->references('id')
                ->on('readers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
