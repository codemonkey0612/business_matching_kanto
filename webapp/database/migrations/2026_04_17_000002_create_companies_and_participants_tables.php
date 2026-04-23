<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name', 150);
            $table->unsignedBigInteger('industry_master_id');
            $table->string('address_text', 255);
            $table->unsignedBigInteger('prefecture_master_id');
            $table->timestamps();

            $table->foreign('industry_master_id')->references('id')->on('industry_masters');
            $table->foreign('prefecture_master_id')->references('id')->on('prefecture_masters');
            $table->index('industry_master_id');
            $table->index('prefecture_master_id');
        });

        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('name', 80)->nullable();
            $table->string('name_kana', 120)->nullable();
            $table->string('role_title', 80)->nullable();
            $table->string('phone_number', 30)->nullable();
            $table->string('email', 255)->unique();
            $table->string('password_hash', 255);
            $table->string('registration_status', 20)->default('draft');
            $table->boolean('agreed_at')->default(false);
            $table->timestamp('agreed_timestamp')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnDelete();
            $table->index('registration_status');
            $table->index('company_id');
        });

        Schema::create('participant_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_id');
            $table->string('business_summary_1', 255);
            $table->string('business_summary_2', 255);
            $table->text('issue_other_text')->nullable();
            $table->text('partner_other_text')->nullable();
            $table->timestamps();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->unique('participant_id');
        });

        Schema::create('participant_issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('issue_master_id');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->foreign('issue_master_id')->references('id')->on('issue_masters')->cascadeOnDelete();
            $table->unique(['participant_id', 'issue_master_id'], 'pi_unique');
        });

        Schema::create('participant_partner_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('partner_type_master_id');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->foreign('partner_type_master_id')->references('id')->on('partner_type_masters')->cascadeOnDelete();
            $table->unique(['participant_id', 'partner_type_master_id'], 'ppt_unique');
        });

        Schema::create('participant_purposes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('purpose_master_id');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->foreign('purpose_master_id')->references('id')->on('purpose_masters')->cascadeOnDelete();
            $table->unique(['participant_id', 'purpose_master_id'], 'pp_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participant_purposes');
        Schema::dropIfExists('participant_partner_types');
        Schema::dropIfExists('participant_issues');
        Schema::dropIfExists('participant_profiles');
        Schema::dropIfExists('participants');
        Schema::dropIfExists('companies');
    }
};
