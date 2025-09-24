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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Dados da Cobrança
            $table->string('title'); // Ex: PPP - João Silva, CAT - Empresa XYZ
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2); // Valor da cobrança
            $table->date('due_date'); // Data de vencimento

            // Status
            $table->enum('status', ['pending', 'paid', 'overdue', 'cancelled'])->default('pending');
            $table->date('paid_at')->nullable();

            // Relacionamento polimórfico (pode ser CAT, PPP ou outro serviço)
            $table->nullableMorphs('billable'); // billable_type, billable_id

            // Dados de pagamento
            $table->string('payment_method')->nullable(); // pix, boleto, cartao
            $table->string('payment_reference')->nullable(); // ID transação, código boleto, etc.
            $table->text('payment_notes')->nullable();

            // Controle admin
            $table->text('admin_notes')->nullable();
            $table->timestamp('sent_at')->nullable(); // Quando foi enviada para o cliente

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
