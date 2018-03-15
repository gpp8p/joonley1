<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('specification',32);
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('optiontype_id');
            $table->timestamps();


            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('optiontype_id')->references('id')->on('optiontype')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
