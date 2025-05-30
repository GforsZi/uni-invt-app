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
        Schema::create('category_assets', function (Blueprint $table) {
            $table->bigIncrements('ctgy_ast_id');
            $table->string('ctgy_ast_name');
            $table->string('ctgy_ast_description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('ctgy_ast_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ctgy_ast_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ctgy_ast_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('ctgy_ast_sys_note')->nullable();

            $table->foreign('ctgy_ast_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ctgy_ast_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ctgy_ast_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'ctgy_ast_updated_at');
            $table->renameColumn('created_at', 'ctgy_ast_created_at');
            $table->renameColumn('deleted_at', 'ctgy_ast_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_assets');
    }
};
