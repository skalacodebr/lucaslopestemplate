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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('professional_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('type'); // 'scheduled' para especialistas, 'live_queue' para clínicos
            $table->string('specialty'); // especialidade médica
            $table->datetime('scheduled_at')->nullable(); // apenas para agendadas
            $table->datetime('started_at')->nullable();
            $table->datetime('ended_at')->nullable();
            $table->string('status'); // pending, confirmed, in_progress, completed, cancelled
            $table->decimal('fee', 8, 2)->default(0);
            $table->string('payment_status')->default('pending'); // pending, paid, refunded
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable();
            $table->text('notes')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('prescription')->nullable();
            $table->string('agora_channel_name')->nullable();
            $table->string('agora_token')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->json('symptoms')->nullable();
            $table->json('attachments')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->datetime('follow_up_date')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->text('review')->nullable();
            $table->timestamps();

            $table->index(['patient_id']);
            $table->index(['professional_id']);
            $table->index(['type']);
            $table->index(['specialty']);
            $table->index(['status']);
            $table->index(['scheduled_at']);
            $table->index(['started_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
