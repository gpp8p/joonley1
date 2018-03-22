<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from_user_id');
            $table->unsignedInteger('billing_id');
            $table->unsignedInteger('shipping_id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('collection_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('message_id');
            $table->unsignedInteger('eventtype_id');
            $table->String('name',64);
            $table->text('comment');
            $table->timestamps();

//            $table->foreign('eventtype_id')->references('id')->on('eventtype')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
}
