<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Registrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lname', 64 );
            $table->string('fname', 64 );
            $table->string('email', 254)->unique();
            $table->string('fname', 64 );
            $table->mediumText('comment');
            $table->string('strname',64);
            $table->smallInteger('roleselected');
            $table->string('strwebsite',128);
            $table->string('straddr1',64);
            $table->string('straddr2', 64);
            $table->string('strcity',64);
            $table->string('strstate',32);
            $table->string('strzip',32);
            $table->string('strid',32);
            $table->string('strestab',16);
            $table->char('reg_status',1);
            $table->char('buysell_type',1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
