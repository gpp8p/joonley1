<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('website',128);
            $table->string('icon',128);
            $table->string ('phone', 64);
            $table->string ('reseller_id', 64);
            $table->string('addr1',128 );
            $table->string('addr2',128 )->nullable();
            $table->string('addr3',128 )->nullable();
            $table->string('city',64 );
            $table->string('state',64 );
            $table->string('zip',12 );
            $table->string('country',64 )->nullable();
            $table->unsignedInteger('location_id');
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
        Schema::dropIfExists('company');
    }
}
