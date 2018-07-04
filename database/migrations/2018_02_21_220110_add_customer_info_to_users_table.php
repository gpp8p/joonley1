<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('admin');
            $table->string('title', 10)->nullable();
            $table->string('lname', 64);
            $table->string('fname',64 );
            $table->string('addr1',128 );
            $table->string('addr2',128 )->nullable();
            $table->string('city',64 );
            $table->string('state',64 );
            $table->string('zip',12 );
            $table->string('country',64 );
            $table->string ('phone', 64);
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('userdetails');
    }
}
