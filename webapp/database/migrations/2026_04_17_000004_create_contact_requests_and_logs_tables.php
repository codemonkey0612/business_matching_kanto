<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from_participant_id');
            $table->unsignedBigInteger('to_participant_id');
            $table->boolean('is_resend')->default(false);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('from_participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->foreign('to_participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->index(['from_participant_id', 'to_participant_id']);
        });

        Schema::create('notification_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contact_request_id');
            $table->unsignedBigInteger('target_participant_id');
            $table->string('target_email', 255);
            $table->string('mail_subject', 255);
            $table->string('send_status', 20)->default('pending');
            $table->unsignedTinyInteger('retry_count')->default(0);
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('contact_request_id')->references('id')->on('contact_requests')->cascadeOnDelete();
            $table->foreign('target_participant_id')->references('id')->on('participants');
            $table->index('send_status');
            $table->index('contact_request_id');
        });

        Schema::create('matching_view_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedInteger('candidate_count');
            $table->timestamp('viewed_at')->useCurrent();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->index('participant_id');
            $table->index('viewed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matching_view_logs');
        Schema::dropIfExists('notification_logs');
        Schema::dropIfExists('contact_requests');
    }
};
