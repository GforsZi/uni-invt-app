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
        Schema::create('asset_descriptions', function (Blueprint $table) {
            $table->bigIncrements('ast_desc_id');
            $table->unsignedBigInteger('ast_desc_description_id')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_desc_asset_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('ast_desc_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_desc_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_desc_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('ast_desc_sys_note')->nullable();

            $table->foreign('ast_desc_created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_desc_updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_desc_deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_desc_description_id')->references('id')->on('description_assets')->onDelete('cascade');
            $table->foreign('ast_desc_asset_id')->references('id')->on('assets')->onDelete('cascade');

            $table->renameColumn('updated_at', 'ast_desc_updated_at');
            $table->renameColumn('created_at', 'ast_desc_created_at');
            $table->renameColumn('deleted_at', 'ast_desc_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_descriptions');
    }
};
