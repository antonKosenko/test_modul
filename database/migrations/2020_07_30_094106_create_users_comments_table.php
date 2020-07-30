<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCommentsTable extends Migration
{
    public $tableName = 'users_comments';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create($this->tableName, function (Blueprint $table) {
            $table->integer('comment_id')->comment('id comment');
            $table->integer('user_id')->comment('id user');

            $table->index(["comment_id"], 'comment');
            $table->index(["user_id"], 'user');
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
