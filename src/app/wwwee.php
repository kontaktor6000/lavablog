<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $servers = \App\Models\ServerModel::all();
        foreach ($servers as $server) {
            \Illuminate\Support\Facades\DB::purge('content');
            \Illuminate\Support\Facades\Config::set('database.connections.content.host', $server->host);
            if (!Schema::connection('content')->hasTable('post_new')) {

                Schema::connection('content')->create('post_new', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->string('title', 255);
                    $table->text('content');
                    $table->timestamps();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $servers = \App\Models\ServerModel::all();
        foreach ($servers as $server) {
            \Illuminate\Support\Facades\DB::purge('content');
            \Illuminate\Support\Facades\Config::set('database.connections.content.host', $server->host);
            if (Schema::connection('content')->hasTable('post_new')) {
                Schema::dropIfExists('post_new');
            }
        }





    }
}
