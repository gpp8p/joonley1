<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('whenmade',12)->nullable();
            $table->string('whomade',24)->nullable();
            $table->string('prodis',1)->nullable();
            $table->unsignedInteger('type_id');
            $table->text('description');
            $table->decimal('price_q1', 8, 2);
            $table->decimal('price_q10', 8, 2);
            $table->unsignedInteger('ship_weight');
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
        Schema::dropIfExists('product');
    }
}
