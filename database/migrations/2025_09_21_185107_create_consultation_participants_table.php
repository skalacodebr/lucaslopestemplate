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
        Schema::create('consultation_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('role'); // patient, professional
            $table->datetime('joined_at')->nullable();
            $table->datetime('left_at')->nullable();
            $table->boolean('audio_enabled')->default(true);
            $table->boolean('video_enabled')->default(true);
            $table->string('connection_status')->default('disconnected'); // connected, disconnected, reconnecting
            $table->json('connection_quality')->nullable(); // métricas de qualidade
            $table->integer('duration_seconds')->default(0);
            $table->timestamps();

            $table->index(['consultation_id']);
            $table->index(['user_id']);
            $table->index(['role']);
            $table->unique(['consultation_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_participants');
    }
};
