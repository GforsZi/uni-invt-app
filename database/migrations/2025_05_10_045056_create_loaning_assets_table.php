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
        Schema::create('loaning_assets', function (Blueprint $table) {
            $table->bigIncrements('lng_ast_id');
            $table->unsignedBigInteger('lng_ast_asset_id')->unsigned()->nullable();
            $table->unsignedBigInteger('lng_ast_loan_id')->unsigned()->nullable();
            $table->unsignedBigInteger('lng_ast_user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('lng_ast_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('lng_ast_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('lng_ast_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('lng_ast_sys_note')->nullable();

            $table->foreign('lng_ast_created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lng_ast_updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lng_ast_deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lng_ast_asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreign('lng_ast_loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->foreign('lng_ast_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'lng_ast_updated_at');
            $table->renameColumn('created_at', 'lng_ast_created_at');
            $table->renameColumn('deleted_at', 'lng_ast_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loaning_assets');
    }
};
