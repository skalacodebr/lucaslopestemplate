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
        Schema::create('cat_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Dados da Empresa
            $table->string('company_name');
            $table->string('cnpj');
            $table->string('company_phone');
            $table->string('company_email');
            $table->text('company_address');

            // Dados do Acidentado
            $table->string('employee_name');
            $table->string('cpf');
            $table->date('birth_date');
            $table->string('job_position');
            $table->date('admission_date');
            $table->string('employee_phone');

            // Dados do Acidente
            $table->date('accident_date');
            $table->time('accident_time');
            $table->string('accident_location');
            $table->text('accident_description');
            $table->string('injury_type');
            $table->string('injured_body_part');
            $table->text('witnesses')->nullable();

            // Atendimento Médico
            $table->boolean('medical_care')->default(false);
            $table->string('hospital_name')->nullable();
            $table->string('doctor_name')->nullable();
            $table->text('medical_report')->nullable();

            // Anexos (JSON para armazenar nomes dos arquivos)
            $table->json('attachments')->nullable();

            // Status e controle
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('processed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_requests');
    }
};
