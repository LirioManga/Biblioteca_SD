<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Recuperação de Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .email-container {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Olá, {{ $nome }}</h2>
        <p>Você solicitou a recuperação da sua palavra-passe. Aqui está sua nova palavra-passe temporária:</p>

        <h3 style="color:#2d3748;">{{ $novaSenha }}</h3>

        <p>Por razões de segurança, recomendamos que você altere essa palavra-passe assim que possível.</p>

        <p class="footer">
            Se você não solicitou essa recuperação, por favor ignore este e-mail ou entre em contato com nosso suporte.
        </p>
    </div>
</body>
</html>
