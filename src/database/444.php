<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParfumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfume', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')->references('id')->on('perfume_categories');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('big_img');
            $table->string('small_img');
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
        Schema::dropIfExists('parfume');
    }
}
