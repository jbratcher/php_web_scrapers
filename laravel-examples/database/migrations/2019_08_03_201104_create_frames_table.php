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
            $table->integer("product_id")->unsigned();
            $table->string("name");
            $table->string("price");
            $table->string("type");
            $table->json("colors");
            $table->string("size");
            $table->string("shape");
            $table->string("spring_hinges");
            $table->string("eligible_progressive_bifocal");
            $table->string("gender");
            $table->string("image");
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
