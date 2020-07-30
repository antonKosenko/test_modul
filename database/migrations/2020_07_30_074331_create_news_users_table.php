<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsUsersTable extends Migration
{

    public $tableName = 'news_users';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->integer('user_id')->comment('id author');
            $table->integer('news_id')->comment('id news');

            $table->unique(["user_id", "news_id"], 'user_news');
            $table->index(["user_id"], 'user');
            $table->index(["news_id"], 'news');

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
