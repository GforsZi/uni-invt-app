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
        Schema::create('returning_assets', function (Blueprint $table) {
            $table->bigIncrements('rtrng_ast_id');
            $table->unsignedBigInteger('rtrng_ast_asset_id')->unsigned()->nullable();
            $table->unsignedBigInteger('rtrng_ast_return_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('rtrng_ast_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('rtrng_ast_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('rtrng_ast_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('rtrng_ast_sys_note')->nullable();

            $table->foreign('rtrng_ast_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rtrng_ast_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rtrng_ast_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rtrng_ast_asset_id')->references('ast_id')->on('assets')->onDelete('cascade');
            $table->foreign('rtrng_ast_return_id')->references('rtrn_id')->on('returns')->onDelete('cascade');

            $table->renameColumn('updated_at', 'rtrng_ast_updated_at');
            $table->renameColumn('created_at', 'rtrng_ast_created_at');
            $table->renameColumn('deleted_at', 'rtrng_ast_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returning_items');
    }
};
