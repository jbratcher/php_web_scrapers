<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("product_id")->unsigned()->nullable();
            $table->string("name")->nullable();
            $table->string("price")->nullable();
            $table->string("image")->nullable();
            $table->string("type")->nullable();
            $table->json("colors")->nullable();
            $table->string("size")->nullable();
            $table->string("shape")->nullable();
            $table->string("spring_hinges")->nullable();
            $table->string("eligible_progressive_bifocal")->nullable();
            $table->string("gender")->nullable();
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
        Schema::dropIfExists('frames');
    }
}
