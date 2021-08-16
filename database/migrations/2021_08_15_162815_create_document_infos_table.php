<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id');
            $table->integer('category_id')->nullable();
            $table->integer('device_prefix_id')->default(1);
            $table->string('device_name');
            $table->text('device_info')->nullable();
            $table->string('origin')->nullable();
            $table->string('unit')->nullable();
            $table->integer('order_qty');
            $table->integer('stock')->default(0);
            $table->integer('recommended_qty')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('total_money')->nullable();
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
        Schema::dropIfExists('document_infos');
    }
}
