<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matching_candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('candidate_participant_id');
            $table->unsignedInteger('rank_no');
            $table->string('match_label', 20)->default('相性が高い');
            $table->unsignedInteger('score_total')->default(0);
            $table->timestamp('calculated_at')->useCurrent();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->foreign('candidate_participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->unique(['participant_id', 'candidate_participant_id'], 'mc_unique');
            $table->index(['participant_id', 'rank_no']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matching_candidates');
    }
};
