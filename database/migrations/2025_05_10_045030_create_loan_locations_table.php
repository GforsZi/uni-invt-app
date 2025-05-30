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
        Schema::create('loan_locations', function (Blueprint $table) {
            $table->bigIncrements('ln_lctn_id');
            $table->unsignedBigInteger('ln_lctn_location_id')->unsigned()->nullable();
            $table->unsignedBigInteger('ln_lctn_room_id')->unsigned()->nullable();
            $table->unsignedBigInteger('ln_lctn_loan_id')->unsigned()->nullable();
            $table->unsignedBigInteger('ln_lctn_asset_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('ln_lctn_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ln_lctn_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ln_lctn_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('ln_lctn_sys_note')->nullable();

            $table->foreign('ln_lctn_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ln_lctn_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ln_lctn_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ln_lctn_location_id')->references('lctn_id')->on('locations')->onDelete('cascade');
            $table->foreign('ln_lctn_room_id')->references('ast_id')->on('assets')->onDelete('cascade');
            $table->foreign('ln_lctn_loan_id')->references('ln_id')->on('loans')->onDelete('cascade');
            $table->foreign('ln_lctn_asset_id')->references('ast_id')->on('assets')->onDelete('cascade');

            $table->renameColumn('updated_at', 'ln_lctn_updated_at');
            $table->renameColumn('created_at', 'ln_lctn_created_at');
            $table->renameColumn('deleted_at', 'ln_lctn_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_location');
    }
};
