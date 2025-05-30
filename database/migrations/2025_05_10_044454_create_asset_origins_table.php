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
        Schema::create('asset_origins', function (Blueprint $table) {
            $table->bigIncrements('ast_orgn_id');
            $table->string('ast_orgn_name');
            $table->string('ast_orgn_description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('ast_orgn_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_orgn_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ast_orgn_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('ast_orgn_sys_note')->nullable();

            $table->foreign('ast_orgn_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ast_orgn_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ast_orgn_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'ast_orgn_updated_at');
            $table->renameColumn('created_at', 'ast_orgn_created_at');
            $table->renameColumn('deleted_at', 'ast_orgn_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_origins');
    }
};
