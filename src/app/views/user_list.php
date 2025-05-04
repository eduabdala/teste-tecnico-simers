<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/simers-theme.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="p-4 bg-light text-dark">
    <div class="container">
        <h1 class="mb-4 text-success">👥 Usuários Cadastrados</h1>
        <div class="mb-3 d-flex gap-2">
            <a href="?action=create" class="btn btn-simers"><i class="bi bi-plus-circle"></i> Criar Usuário</a>
            <a href="?action=index" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
        </div>

        <?php if (empty($users)): ?>
            <div class="alert alert-warning">Nenhum usuário encontrado.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Data de Nascimento</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars($user['cpf']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['birth_date']) ?></td>
                                <td><?= htmlspecialchars($user['phone']) ?></td>
                                <td class="text-center">
                                    <a href="?action=edit&id=<?= $user['id'] ?>" class="btn btn-outline-success btn-sm me-1">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <a href="?action=delete&id=<?= $user['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                                        <i class="bi bi-trash"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
    </div>
</body>
</html>
