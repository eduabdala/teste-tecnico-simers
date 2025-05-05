<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/simers-theme.css">
</head>
<body class="p-4 bg-light text-dark">
    <div class="container">
        <h1 class="mb-4 text-success">✏️ Editar Usuário</h1>

        <form method="POST" action="?action=edit&id=<?= $user['id'] ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" id="cpf" name="cpf" class="form-control" value="<?= htmlspecialchars($user['cpf']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="<?= $user['birth_date'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" id="telefone" name="telefone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Nova Senha <small class="text-muted">(opcional)</small></label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Deixe em branco para manter a senha atual">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-simers">
                    <i class="bi bi-check-circle"></i> Atualizar
                </button>
                <a href="?action=readAll" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </form>
    </div>
    
    <script>
        document.getElementById('userForm').addEventListener('submit', function (event) {
            const name = document.getElementById('name').value.trim();
            const cpf = document.getElementById('cpf').value.trim();
            const email = document.getElementById('email').value.trim();
            const birthDate = document.getElementById('birth_date').value;
            const phone = document.getElementById('phone').value.trim();
            const password = document.getElementById('password').value;

            const nameRegex = /^[A-Za-zÀ-ÿ\s]+$/;
            const cpfRegex = /^\d{11}$/;
            const phoneRegex = /^\d{10,11}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!nameRegex.test(name)) {
                alert("O nome deve conter apenas letras e espaços.");
                event.preventDefault();
                return;
            }

            if (!cpfRegex.test(cpf)) {
                alert("O CPF deve conter exatamente 11 números.");
                event.preventDefault();
                return;
            }

            if (!emailRegex.test(email)) {
                alert("E-mail inválido.");
                event.preventDefault();
                return;
            }

            if (!birthDate) {
                alert("Data de nascimento é obrigatória.");
                event.preventDefault();
                return;
            }

            if (!phoneRegex.test(phone)) {
                alert("O telefone deve conter entre 10 e 11 números.");
                event.preventDefault();
                return;
            }

            if (password.length < 6) {
                alert("A senha deve ter pelo menos 6 caracteres.");
                event.preventDefault();
                return;
            }
        });
    </script>
</body>
</html>
