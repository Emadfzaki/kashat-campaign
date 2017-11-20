<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultiMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_media', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('content_type', ['campaign', 'product', 'category']);
            $table->integer('content_id');
            $table->string('file_location');
            $table->string('file_type');
            $table->string('title');

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
        Schema::dropIfExists('multi_media');
    }
}
