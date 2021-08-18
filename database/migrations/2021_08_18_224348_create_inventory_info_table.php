<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_info', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_id');
            $table->string('device_name');
            $table->string('device_code')->nullable();
            $table->string('serial')->nullable();
            $table->date('date_purchase');
            $table->string('unit')->nullable();
            $table->integer('qty_document');
            $table->double('price_document');
            $table->integer('qty_inventory');
            $table->double('price_inventory');
            $table->string('funds')->nullable();
            $table->double('estimate_price');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('inventory_info');
    }
}
