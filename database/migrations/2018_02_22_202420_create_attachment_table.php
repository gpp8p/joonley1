<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('attachmenttype_id');
            $table->string('url',64);
            $table->timestamps();

            $table->unique(['event_id','attachmenttype_id']);
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('attachmenttype_id')->references('id')->on('atachmenttype')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachment');
    }
}
