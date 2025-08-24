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
        Schema::create('returns', function (Blueprint $table) {
            $table->bigIncrements('rtrn_id');
            $table->unsignedBigInteger('rtrn_user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('rtrn_loan_id')->unsigned()->nullable();
            $table->string('rtrn_description')->nullable();
            $table->string('rtrn_note')->nullable();
            $table->boolean('rtrn_accepted')->nullable();
            $table->date('rtrn_approved_at')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('rtrn_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('rtrn_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('rtrn_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('sys_note')->nullable();

            $table->foreign('rtrn_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rtrn_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rtrn_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rtrn_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rtrn_loan_id')->references('ln_id')->on('loans')->onDelete('cascade');

            $table->renameColumn('updated_at', 'rtrn_updated_at');
            $table->renameColumn('created_at', 'rtrn_created_at');
            $table->renameColumn('deleted_at', 'rtrn_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
