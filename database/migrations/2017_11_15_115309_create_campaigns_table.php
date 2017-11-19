<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('product_id');
            $table->integer('vendor_id');
            $table->dateTimeTz('start_date');
            $table->dateTimeTz('end_date');
            $table->enum('status', ['pending', 'approved', 'active', 'deactivated']);
            $table->integer('approved_by')->nullable();
            $table->string('target_country');
            $table->string('locale');
            $table->text('extra');
            $table->integer('created_by');
            $table->integer('updated_by');

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
        Schema::dropIfExists('campaigns');
    }
}
