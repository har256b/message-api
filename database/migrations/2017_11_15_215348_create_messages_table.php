<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('uid');
            $table->string('sender');
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(0);
            $table->boolean('is_archived')->default(0);
            $table->double('time_sent');
            $table->double('time_read')->nullable();
            $table->double('time_archived')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
