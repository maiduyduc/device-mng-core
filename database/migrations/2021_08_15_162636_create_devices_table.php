<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->integer('device_prefix_id');
            $table->string('full_number')->unique();
            $table->integer('room_id')->nullable();
            $table->integer('device_group_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('handover_id');
            $table->string('device_name');
            $table->text('device_info')->nullable();
            $table->string('serial')->nullable();
            $table->string('unit')->nullable();
            $table->string('status')->default('inactive');
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
        Schema::dropIfExists('devices');
    }
}
