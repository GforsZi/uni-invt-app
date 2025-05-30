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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('usr_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('usr_activation')->default(false);
            $table->unsignedBigInteger('usr_role_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('usr_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('usr_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('usr_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('usr_sys_note')->nullable();

            $table->foreign('usr_created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usr_updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usr_deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usr_role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->renameColumn('updated_at', 'usr_updated_at');
            $table->renameColumn('created_at', 'usr_created_at');
            $table->renameColumn('deleted_at', 'usr_deleted_at');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
