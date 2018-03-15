<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCanBeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compcanbe', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ctype_id');
            $table->unsignedInteger('company_id');
            $table->timestamps();

            $table->unique(['ctype_id','company_id']);
            $table->foreign('ctype_id')->references('id')->on('companytype')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compcanbe');
    }
}
