<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medialink', function (Blueprint $table) {
            $table->increments('id');
//            $table->unsignedInteger('reference_id');
            $table->string('pertainsto',12);
            $table->unsignedInteger('mediatype_id');
            $table->string('url',128);
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
        Schema::dropIfExists('medialink');
    }
}
