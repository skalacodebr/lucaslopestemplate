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
        Schema::create('consultation_queue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('consultation_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('specialty')->default('Clínico Geral'); // sempre clínico geral para fila
            $table->integer('position')->default(0); // posição na fila
            $table->string('status'); // waiting, matched, in_consultation, completed, cancelled
            $table->json('symptoms')->nullable(); // sintomas informados
            $table->text('notes')->nullable(); // observações do paciente
            $table->integer('estimated_wait_minutes')->nullable();
            $table->datetime('joined_at'); // quando entrou na fila
            $table->datetime('matched_at')->nullable(); // quando foi pareado com médico
            $table->datetime('consultation_started_at')->nullable();
            $table->datetime('left_queue_at')->nullable();
            $table->string('leave_reason')->nullable(); // cancelled_by_patient, timeout, completed
            $table->timestamps();

            $table->index(['patient_id']);
            $table->index(['status']);
            $table->index(['position']);
            $table->index(['joined_at']);
            $table->index(['specialty']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_queue');
    }
};
