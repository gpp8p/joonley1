<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContainedInCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collectionhas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('containedas_id');
            $table->unsignedInteger('collection_id');
            $table->timestamps();

            $table->unique(['product_id','containedas_id','collection_id']);
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('containedas_id')->references('id')->on('containedas')->onDelete('cascade');
            $table->foreign('collection_id')->references('id')->on('collection')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collectionhas');
    }
}
