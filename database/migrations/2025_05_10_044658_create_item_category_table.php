<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id')->unsigned()->nullable();
            $table->unsignedBigInteger('category_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('sys_note')->nullable();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_category');
    }
};
