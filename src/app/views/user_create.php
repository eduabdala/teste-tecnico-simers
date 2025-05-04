<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Usuário</title>
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/simers-theme.css">
</head>
<body class="p-4 bg-light text-dark">
    <div class="container">
        <h1 class="mb-4 text-primary">➕ Criar Usuário</h1>

        <form id="userForm" method="POST" action="?action=create">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" placeholder="Digite apenas números" id="cpf" name="cpf" class="form-control" required maxlength="11">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">Data de Nascimento</label>
                <input type="date" id="birth_date" name="birth_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" id="phone" name="phone" class="form-control" required maxlength="11">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-simers">
                    <i class="bi bi-person-plus"></i> Criar
                </button>
                <a href="?action=index" class="btn btn-outline-secondary">
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
