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
        Schema::create('description_assets', function (Blueprint $table) {
            $table->bigIncrements('desc_ast_id');
            $table->string('desc_ast_description');
            $table->string('desc_ast_value');
            $table->timestamps();
            $table->unsignedBigInteger('desc_ast_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('desc_ast_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('desc_ast_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('desc_ast_sys_note')->nullable();

            $table->foreign('desc_ast_created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('desc_ast_updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('desc_ast_deleted_by')->references('id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'desc_ast_updated_at');
            $table->renameColumn('created_at', 'desc_ast_created_at');
            $table->renameColumn('deleted_at', 'desc_ast_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('description_assets');
    }
};
