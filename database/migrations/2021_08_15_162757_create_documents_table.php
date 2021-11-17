<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->integer('document_prefix_id')->default(1);
            $table->string('full_number')->unique();
            $table->string('code')->nullable();
            $table->string('name');
            $table->integer('qty');
            $table->string('status')->default('pending');
            $table->boolean('can_edit')->default(1);
            $table->boolean('can_export')->default(0);
            $table->boolean('is_export')->default(0);
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
        Schema::dropIfExists('documents');
    }
}
