<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function($t){
            $t->increments('id');
            $t->integer('user_id')->foreign()->on('users')->references('id')->onDelete('cascade');
            $t->integer('client_id')->foreign()->on('users')->references('id')->onDelete('cascade');
            $t->datetime('approved_at')->nullable();
            $t->timestamps();
            $t->softDeletes();
            $t->unique(['user_id', 'client_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
