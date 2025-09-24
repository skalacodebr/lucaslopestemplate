<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação PPP Recebida</title>
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
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 30px;
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
        .status {
            display: inline-block;
            background: #fbbf24;
            color: #92400e;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .urgent {
            background: #ef4444;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📄 Solicitação PPP Recebida</h1>
            <p>Sua solicitação foi registrada com sucesso!</p>
        </div>

        <div class="content">
            <h2>Olá, {{ $pppRequest->user->name }}!</h2>

            <p>Recebemos sua solicitação de <strong>Perfil Profissiográfico Previdenciário (PPP)</strong> e nossa equipe já foi notificada.</p>

            <div class="info-box">
                <h3>📋 Detalhes da Solicitação</h3>
                <p><strong>Funcionário:</strong> {{ $pppRequest->employee_name }}</p>
                <p><strong>Motivo:</strong> {{ ucfirst($pppRequest->request_reason) }}</p>
                <p><strong>Período:</strong> {{ $pppRequest->period_start->format('d/m/Y') }} a {{ $pppRequest->period_end->format('d/m/Y') }}</p>
                @if($pppRequest->is_urgent)
                    <p><strong>🚨 URGENTE:</strong> {{ $pppRequest->urgency_reason }}</p>
                @endif
                <p><strong>Valor:</strong> R$ {{ number_format($pppRequest->price, 2, ',', '.') }}</p>
                <p><strong>Status:</strong>
                    <span class="status @if($pppRequest->is_urgent) urgent @endif">
                        @if($pppRequest->is_urgent) URGENTE @else PENDENTE @endif
                    </span>
                </p>
            </div>

            <h3>📞 Próximos Passos:</h3>
            <ul>
                @if($pppRequest->is_urgent)
                    <li><strong>Processamento prioritário</strong> (até 24 horas)</li>
                @else
                    <li>Processamento padrão (até 5 dias úteis)</li>
                @endif
                <li>Nossa equipe analisará os dados fornecidos</li>
                <li>Enviaremos uma cobrança detalhada</li>
                <li>Após confirmação do pagamento, iniciaremos o processo</li>
            </ul>

            <p><strong>Suas credenciais de acesso foram criadas:</strong></p>
            <div class="info-box">
                <p><strong>Email:</strong> {{ $pppRequest->company_email }}</p>
                <p><strong>Senha:</strong> password123</p>
                <p><a href="{{ route('client.login') }}">🔐 Acessar Área do Cliente</a></p>
            </div>

            <p>Em caso de dúvidas, entre em contato conosco pelo WhatsApp: <strong>{{ config('app.whatsapp') }}</strong></p>
        </div>

        <div class="footer">
            <p><strong>Global SST</strong><br>
            Especialistas em Saúde e Segurança do Trabalho<br>
            {{ config('app.email') }} | {{ config('app.phone') }}</p>
        </div>
    </div>
</body>
</html>