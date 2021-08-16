<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandoverInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handover_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('device_prefix_id')->default(1);
            $table->integer('category_id')->nullable();
            $table->integer('handover_id');
            $table->string('device_name');
            $table->text('device_info')->nullable();
            $table->string('origin')->nullable();
            $table->string('unit')->nullable();
            $table->integer('qty');
            $table->string('serial')->nullable();
            $table->date('purchase_date')->default(now());
            $table->integer('inventory_qty')->nullable();
            $table->boolean('inv_status')->default(1);
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
        Schema::dropIfExists('handover_infos');
    }
}
