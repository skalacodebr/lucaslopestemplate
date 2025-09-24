<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Cobrança - Global SST</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 30px;
        }
        .billing-box {
            border: 2px solid #059669;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
            background: #f0fdf4;
        }
        .amount {
            font-size: 32px;
            font-weight: bold;
            color: #059669;
            text-align: center;
            margin: 15px 0;
        }
        .info-box {
            background: #f1f5f9;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .footer {
            background: #f8fafc;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            color: #64748b;
            font-size: 14px;
        }
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin: 15px 0;
        }
        .payment-method {
            background: #e5e7eb;
            padding: 10px;
            text-align: center;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💰 Nova Cobrança</h1>
            <p>Uma cobrança foi gerada para você</p>
        </div>

        <div class="content">
            <h2>Olá, {{ $billing->user->name }}!</h2>

            <p>Geramos uma nova cobrança relacionada ao serviço solicitado. Confira os detalhes abaixo:</p>

            <div class="billing-box">
                <h3 style="margin-top: 0; color: #059669;">{{ $billing->title }}</h3>

                @if($billing->description)
                    <p><strong>Descrição:</strong> {{ $billing->description }}</p>
                @endif

                <div class="amount">R$ {{ number_format($billing->amount, 2, ',', '.') }}</div>

                <p><strong>📅 Vencimento:</strong> {{ $billing->due_date->format('d/m/Y') }}</p>

                @if($billing->billable)
                    <p><strong>🔗 Referente a:</strong>
                        @if($billing->billable_type === 'App\\Models\\CatRequest')
                            CAT - {{ $billing->billable->employee_name }}
                        @elseif($billing->billable_type === 'App\\Models\\PppRequest')
                            PPP - {{ $billing->billable->employee_name }}
                        @endif
                    </p>
                @endif
            </div>

            <h3>💳 Formas de Pagamento Aceitas:</h3>
            <div class="payment-methods">
                <div class="payment-method">💳 PIX</div>
                <div class="payment-method">🏦 Boleto</div>
                <div class="payment-method">💎 Cartão</div>
                <div class="payment-method">💵 Dinheiro</div>
                <div class="payment-method">🔄 Transferência</div>
            </div>

            <div class="info-box">
                <h3>📱 Acesse sua Área do Cliente</h3>
                <p>Para ver todos os detalhes da cobrança e histórico:</p>
                <p><strong>Email:</strong> {{ $billing->user->email }}</p>
                <p><strong>Senha:</strong> password123</p>
                <p><a href="{{ route('client.login') }}" style="color: #2563eb;">🔐 Acessar Área do Cliente</a></p>
            </div>

            <h3>📞 Dúvidas sobre o pagamento?</h3>
            <p>Entre em contato conosco:</p>
            <ul>
                <li><strong>WhatsApp:</strong> {{ config('app.whatsapp') }}</li>
                <li><strong>E-mail:</strong> {{ config('app.email') }}</li>
                <li><strong>Telefone:</strong> {{ config('app.phone') }}</li>
            </ul>

            <p><em>Mantenha seus dados sempre atualizados para evitar problemas na entrega dos serviços.</em></p>
        </div>

        <div class="footer">
            <p><strong>Global SST</strong><br>
            Especialistas em Saúde e Segurança do Trabalho<br>
            {{ config('app.email') }} | {{ config('app.phone') }}</p>
        </div>
    </div>
</body>
</html>