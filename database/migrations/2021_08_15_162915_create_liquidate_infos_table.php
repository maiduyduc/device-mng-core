<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidate_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('liquidate_id');
            $table->integer('room_id')->nullable();
            $table->string('full_number');
            $table->string('device_name');
            $table->text('device_info')->nullable();
            $table->double('price');
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('liquidate_infos');
    }
}
