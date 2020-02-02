<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->year('years');
            $table->bigInteger('publishing_house_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->timestamps();

            $table->foreign('publishing_house_id')
                    ->references('id')
                    ->on('publishing_houses');

            $table->foreign('author_id')
                ->references('id')
                ->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
