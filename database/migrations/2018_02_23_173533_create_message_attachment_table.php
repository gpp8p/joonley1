<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messageattach', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('message_id');
            $table->unsignedInteger('attachmenttype_id');
            $table->string('url',64);
            $table->timestamps();

            $table->unique(['message_id','attachmenttype_id']);
            $table->foreign('message_id')->references('id')->on('message')->onDelete('cascade');
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
        Schema::dropIfExists('messageattach');
    }
}
