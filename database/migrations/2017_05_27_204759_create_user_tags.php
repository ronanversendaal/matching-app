<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tags', function($t){
            $t->increments('id');
            $t->string('name');
            $t->integer('user_id')->unsigned();
            $t->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $t->index(['id', 'user_id']);
            $t->timestamps();
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tags');
    }
}
