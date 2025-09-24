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
        Schema::create('ppp_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Dados da Empresa
            $table->string('company_name');
            $table->string('cnpj');
            $table->string('company_phone');
            $table->string('company_email');

            // Dados do Funcionário
            $table->string('employee_name');
            $table->string('cpf');
            $table->date('birth_date');
            $table->date('admission_date');
            $table->date('dismissal_date')->nullable();
            $table->string('job_position');

            // Dados da Solicitação
            $table->string('request_reason');
            $table->date('period_start');
            $table->date('period_end');
            $table->text('observations')->nullable();

            // Urgência
            $table->boolean('is_urgent')->default(false);
            $table->text('urgency_reason')->nullable();

            // Status e controle
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->decimal('price', 8, 2)->nullable(); // Preço calculado (normal/urgente)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppp_requests');
    }
};
