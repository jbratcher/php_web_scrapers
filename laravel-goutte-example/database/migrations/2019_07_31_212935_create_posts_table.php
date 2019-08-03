<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("title")->nullable();
            $table->text("link")->nullable();
            $table->text("image_src")->nullable();
            $table->string("subreddit")->nullable();
            $table->text("subreddit_link")->nullable();
            $table->string("user")->nullable();
            $table->text("user_link")->nullable();
            $table->string("upvotes")->nullable();
            $table->string("comment_count")->nullable();
            $table->text("comment_link")->nullable();
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
        Schema::dropIfExists('posts');
    }
}
