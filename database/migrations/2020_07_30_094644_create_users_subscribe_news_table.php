<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSubscribeNewsTable extends Migration
{
    public $tableName = 'users_subscribe_news';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create($this->tableName, function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->comment('id user');
            $table->integer('subscribe_user_id')->unsigned()->comment('id user subscribe');
            $table->index(["user_id"], 'user');
            $table->index(["subscribe_user_id"], 'subscribe_user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
