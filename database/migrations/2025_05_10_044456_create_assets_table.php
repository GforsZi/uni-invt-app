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
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('ast_id');
            $table->string('ast_name');
            $table->string('ast_img_path')->nullable();
            $table->string('ast_barcode')->nullable();
            $table->unsignedBigInteger('ast_category_id')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_origin_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('ast_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('ast_sys_note')->nullable();

            $table->foreign('ast_created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_category_id')->references('id')->on('category_assets')->onDelete('cascade');
            $table->foreign('ast_origin_id')->references('id')->on('asset_origins')->onDelete('cascade');

            $table->renameColumn('updated_at', 'ast_updated_at');
            $table->renameColumn('created_at', 'ast_created_at');
            $table->renameColumn('deleted_at', 'ast_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
