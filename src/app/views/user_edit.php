<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/simers-theme.css">
</head>
<body class="p-4 bg-light text-dark">
    <div class="container">
        <h1 class="mb-4 text-success">✏️ Edit User</h1>

        <form method="POST" action="?action=edit&id=<?= $user['id'] ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Name</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" id="cpf" name="cpf" class="form-control" value="<?= htmlspecialchars($user['cpf']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Birth Date</label>
                <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="<?= $user['birth_date'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Phone</label>
                <input type="text" id="telefone" name="telefone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">New Password <small class="text-muted">(optional)</small></label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Leave blank to keep current password">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-simers">
                    <i class="bi bi-check-circle"></i> Update
                </button>
                <a href="?action=readAll" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>
</body>
</html>
