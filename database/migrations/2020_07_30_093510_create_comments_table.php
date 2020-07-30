<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    public $tableName = 'comments';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('id author');
            $table->integer('news_id')->unsigned()->comment('id news');
            $table->integer('parent_id')->nullable()->default(null);
            $table->text('body');
            $table->timestamps();

            $table->index(["parent_id"], 'parent_id');
            $table->index(["user_id"], 'user_id');
            $table->index(["news_id"], 'news_id');
        //    $table->unique(["user_id", "news_id", "parent_id"], 'ids');
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
