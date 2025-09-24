<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação CAT Recebida</title>
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
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚨 Solicitação CAT Recebida</h1>
            <p>Sua solicitação foi registrada com sucesso!</p>
        </div>

        <div class="content">
            <h2>Olá, {{ $catRequest->user->name }}!</h2>

            <p>Recebemos sua solicitação de <strong>Comunicação de Acidente do Trabalho (CAT)</strong> e nossa equipe já foi notificada.</p>

            <div class="info-box">
                <h3>📋 Detalhes da Solicitação</h3>
                <p><strong>Funcionário:</strong> {{ $catRequest->employee_name }}</p>
                <p><strong>Data do Acidente:</strong> {{ $catRequest->accident_date->format('d/m/Y') }}</p>
                <p><strong>Horário:</strong> {{ $catRequest->accident_time }}</p>
                <p><strong>Local:</strong> {{ $catRequest->accident_location }}</p>
                <p><strong>Status:</strong> <span class="status">PENDENTE</span></p>
            </div>

            <h3>📞 Próximos Passos:</h3>
            <ul>
                <li>Nossa equipe analisará os dados fornecidos</li>
                <li>Entraremos em contato em até 24 horas</li>
                <li>Providenciaremos toda a documentação necessária</li>
            </ul>

            <p><strong>Suas credenciais de acesso foram criadas:</strong></p>
            <div class="info-box">
                <p><strong>Email:</strong> {{ $catRequest->company_email }}</p>
                <p><strong>Senha:</strong> password123</p>
                <p><a href="{{ route('client.login') }}">🔐 Acessar Área do Cliente</a></p>
            </div>

            <p>Em caso de urgência, entre em contato conosco pelo WhatsApp: <strong>{{ config('app.whatsapp') }}</strong></p>
        </div>

        <div class="footer">
            <p><strong>Global SST</strong><br>
            Especialistas em Saúde e Segurança do Trabalho<br>
            {{ config('app.email') }} | {{ config('app.phone') }}</p>
        </div>
    </div>
</body>
</html>