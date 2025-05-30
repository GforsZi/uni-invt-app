<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\PseudoTypes\False_;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('ln_id');
            $table->unsignedBigInteger('ln_user_id')->unsigned()->nullable();
            $table->string('ln_description')->nullable();
            $table->boolean('ln_status')->default(true);
            $table->date('ln_loan_limit')->nullable();
            $table->boolean('ln_accepted')->default(false);
            $table->date('ln_approved_at')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('ln_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ln_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ln_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('ln_sys_note')->nullable();

            $table->foreign('ln_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ln_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ln_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ln_user_id')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'ln_updated_at');
            $table->renameColumn('created_at', 'ln_created_at');
            $table->renameColumn('deleted_at', 'ln_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
