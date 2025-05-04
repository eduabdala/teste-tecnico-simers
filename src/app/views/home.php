<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Simers | User Manager</title>
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/simers-theme.css">

    <style>
        :root {
            --simers-green: #007a3d;
            --simers-light-green: #e6f4ef;
            --simers-dark: #004d29;
        }

        body {
            background-color: var(--simers-light-green);
        }

        .hero {
            background-color: white;
            padding: 4rem 2rem;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 4rem;
        }

        .btn-simers {
            background-color: var(--simers-green);
            color: white;
            border: none;
        }

        .btn-simers:hover {
            background-color: var(--simers-dark);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1 class="mb-3">Bem-vindo ao <strong>Simers User Manager</strong> 👋</h1>
            <p class="mb-4 text-muted">Gerencie os usuários de forma prática e rápida.</p>
            <a href="?action=create" class="btn btn-simers me-2">+ Criar Novo Usuário</a>
            <a href="?action=readAll" class="btn btn-outline-success">📋 Listar Usuários</a>
        </div>
    </div>
</body>
</html>
