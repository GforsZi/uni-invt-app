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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('lctn_id');
            $table->string('lctn_name');
            $table->double('lctn_latitude', 10, 7);
            $table->double('lctn_longitude', 10, 7);
            $table->string('lctn_img_path')->nullable();
            $table->string('lctn_img_public_id')->nullable();
            $table->string('lctn_description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('lctn_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('lctn_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('lctn_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('sys_note')->nullable();

            $table->foreign('lctn_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('lctn_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('lctn_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'lctn_updated_at');
            $table->renameColumn('created_at', 'lctn_created_at');
            $table->renameColumn('deleted_at', 'lctn_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
