<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('profile_image')->nullable();
            $table->date('birthday');
            $table->enum('gender', ['man', 'woman']);
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('referral_code_id')->unsigned()->nullable();
            $table->bigInteger('account_tariff_id')->unsigned()->default(1);
            $table->enum('account_type', ['real', 'fake'])->default('fake');
            $table->enum('is_active', [0, 1])->default(0);
            $table->text('about')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('referral_code_id')->references('id')->on('referral_codes');
            $table->foreign('account_tariff_id')->references('id')->on('account_tariffs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
