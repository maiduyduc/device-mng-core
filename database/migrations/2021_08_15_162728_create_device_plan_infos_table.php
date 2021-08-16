<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicePlanInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_plan_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->integer('device_plan_id');
            $table->string('device_name');
            $table->string('device_info')->nullable();
            $table->string('unit')->nullable();
            $table->integer('qty');
            $table->text('note')->nullable();
            $table->boolean('is_buy')->default(0);
            $table->boolean('is_in_use')->default(0);
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
        Schema::dropIfExists('device_plan_infos');
    }
}
