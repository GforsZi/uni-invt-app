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
        Schema::create('asset_logs', function (Blueprint $table) {
            $table->bigIncrements('ast_lg_id');
            $table->enum('ast_lg_status', ['increase', 'reduce']);
            $table->string('ast_lg_note')->nullable();
            $table->unsignedBigInteger('ast_lg_asset_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('ast_lg_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_lg_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_lg_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('ast_lg_sys_note')->nullable();

            $table->foreign('ast_lg_created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_lg_updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_lg_deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ast_lg_asset_id')->references('id')->on('assets')->onDelete('cascade');

            $table->renameColumn('updated_at', 'ast_lg_updated_at');
            $table->renameColumn('created_at', 'ast_lg_created_at');
            $table->renameColumn('deleted_at', 'ast_lg_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_logs');
    }
};
