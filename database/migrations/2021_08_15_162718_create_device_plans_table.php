<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->integer('document_prefix_id')->default(2);
            $table->string('full_number')->unique();
            $table->string('name');
            $table->integer('qty');
            $table->string('status')->default('pending');
            $table->boolean('can_edit')->default(1);
            $table->boolean('can_export')->default(0);
            $table->boolean('is_export')->default(0);
            $table->integer('num_device_in_use')->default(0);
            $table->integer('num_device_not_use');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('device_plans');
    }
}
