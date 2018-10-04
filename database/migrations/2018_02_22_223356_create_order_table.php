<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('status');
            $table->unsignedInteger('cust_comp_id');
            $table->unsignedInteger('seller_comp_id')->nullable(true);
            $table->decimal('shipping',6,2);
            $table->decimal('tax',6,2);
            $table->decimal('discount',8,3);
            $table->timestamps();
        });
    }

// note nullable attribute for seller_comp_id must be removed prior to production
//must be used to constrain items so they all come from the same seller

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
