<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoInventoryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_inventory_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('auto_inventory_id');
            $table->string('device_name');
            $table->integer('room_id')->nullable();
            $table->integer('qty');
            $table->integer('error_qty')->default(0);
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
        Schema::dropIfExists('auto_inventory_infos');
    }
}
