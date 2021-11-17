<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidates', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->integer('document_prefix_id');
            $table->string('full_number');
            $table->string('name');
            $table->integer('qty');
            $table->string('status')->default('pending');
            $table->text('note')->nullable();
            $table->boolean('can_edit')->default(1);
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
        Schema::dropIfExists('liquidates');
    }
}
