<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_systems', function (Blueprint $table) {
            $table->id();
            $table->string('document_id');
            $table->integer('approved')->default(0); //đã phê duyệt
            $table->integer('approved_but_not_use')->default(0); //đã phê duyệt nhưng chưa sử dụng
            $table->integer('pending')->default(0); //đợi xử lý
            $table->integer('refuse')->default(0); //đã từ chối
            $table->integer('total')->default(0); //tổng
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
        Schema::dropIfExists('document_systems');
    }
}
