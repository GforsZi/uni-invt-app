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
        Schema::create('relation_assets', function (Blueprint $table) {
            $table->bigIncrements('rltn_ast_id');
            $table->unsignedBigInteger('rltn_ast_room_id')->unsigned()->nullable();
            $table->unsignedBigInteger('rltn_ast_asset_id')->unsigned()->nullable();
            $table->unsignedBigInteger('rltn_ast_location_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('rltn_ast_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('rltn_ast_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('rltn_ast_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('rltn_ast_sys_note')->nullable();

            $table->foreign('rltn_ast_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rltn_ast_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rltn_ast_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->foreign('rltn_ast_room_id')->references('ast_id')->on('assets')->onDelete('cascade');
            $table->foreign('rltn_ast_asset_id')->references('ast_id')->on('assets')->onDelete('cascade');
            $table->foreign('rltn_ast_location_id')->references('lctn_id')->on('locations')->onDelete('cascade');

            $table->renameColumn('updated_at', 'rltn_ast_updated_at');
            $table->renameColumn('created_at', 'rltn_ast_created_at');
            $table->renameColumn('deleted_at', 'rltn_ast_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relation_assets');
    }
};
