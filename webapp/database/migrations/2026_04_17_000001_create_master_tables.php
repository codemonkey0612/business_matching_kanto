<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prefecture_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->string('area_group', 30)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('industry_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('issue_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->string('category_name', 50)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('partner_type_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->string('category_name', 50)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('purpose_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('issue_partner_affinities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('issue_master_id');
            $table->unsignedBigInteger('partner_type_master_id');
            $table->unsignedTinyInteger('score')->default(10);
            $table->timestamps();

            $table->foreign('issue_master_id')->references('id')->on('issue_masters')->cascadeOnDelete();
            $table->foreign('partner_type_master_id')->references('id')->on('partner_type_masters')->cascadeOnDelete();
            $table->unique(['issue_master_id', 'partner_type_master_id'], 'issue_partner_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issue_partner_affinities');
        Schema::dropIfExists('purpose_masters');
        Schema::dropIfExists('partner_type_masters');
        Schema::dropIfExists('issue_masters');
        Schema::dropIfExists('industry_masters');
        Schema::dropIfExists('prefecture_masters');
    }
};
