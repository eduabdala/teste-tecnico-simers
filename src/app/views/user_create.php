<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Usuário</title>
    <!-- Favicon for the webpage -->
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons for using icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom stylesheet (optional) -->
    <link rel="stylesheet" href="css/simers-theme.css">
</head>
<body class="p-4 bg-light text-dark">
    <div class="container">
        <!-- Page heading for creating a user -->
        <h1 class="mb-4 text-primary">➕ Criar Usuário</h1>

        <!-- Form to create a new user -->
        <form id="userForm" method="POST" action="?action=create">
            <!-- Input field for the user's name -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <!-- Input field for the user's CPF (Brazilian Social Security Number) -->
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" placeholder="Digite apenas números" id="cpf" name="cpf" class="form-control" required maxlength="14">
            </div>

            <!-- Input field for the user's email -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <!-- Input field for the user's birthdate -->
            <div class="mb-3">
                <label for="birth_date" class="form-label">Data de Nascimento</label>
                <input type="date" id="birth_date" name="birth_date" class="form-control" required>
            </div>

            <!-- Input field for the user's phone number -->
            <div class="mb-3">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" id="phone" name="phone" class="form-control" required maxlength="15">
            </div>

            <!-- Input field for the user's password -->
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <!-- Buttons for submitting the form and going back to the user list -->
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

    <!-- JQuery Mask Plugin for input masks (phone and CPF) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            // Apply input masks for CPF and phone
            $('#cpf').mask('000.000.000-00'); // CPF format
            $('#phone').mask('(00) 00000-0000'); // Phone format
        });
    </script>

    <!-- JavaScript for form validation -->
    <script>
        // Event listener for the form submit
        document.getElementById('userForm').addEventListener('submit', function (event) {
            // Collect the form input values
            const name = document.getElementById('name').value.trim();
            const cpf = document.getElementById('cpf').value.trim();
            const email = document.getElementById('email').value.trim();
            const birthDate = document.getElementById('birth_date').value;
            const phone = document.getElementById('phone').value.trim();
            const password = document.getElementById('password').value;

            // Regular expressions for validation
            const nameRegex = /^[A-Za-zÀ-ÿ\s]+$/; // Name should contain only letters and spaces
            const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/; // CPF format with dots and hyphen
            const phoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/; // Phone format with parentheses and hyphen
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email validation pattern

            // Validate the name
            if (!nameRegex.test(name)) {
                alert("O nome deve conter apenas letras e espaços.");
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Validate the CPF
            if (!cpfRegex.test(cpf)) {
                alert("O CPF deve conter exatamente 11 números.");
                event.preventDefault();
                return;
            }

            // Validate the email
            if (!emailRegex.test(email)) {
                alert("E-mail inválido.");
                event.preventDefault();
                return;
            }

            // Validate the birth date
            if (!birthDate) {
                alert("Data de nascimento é obrigatória.");
                event.preventDefault();
                return;
            }

            // Validate the phone number
            if (!phoneRegex.test(phone)) {
                alert("O telefone deve conter entre 10 e 11 números.");
                event.preventDefault();
                return;
            }

            // Validate the password strength
            const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{6,}$/;
            if (!strongPasswordRegex.test(password)) {
                alert("A senha deve ter pelo menos 6 caracteres, incluindo uma letra maiúscula, uma letra minúscula, um número e um caractere especial.");
                event.preventDefault();
                return;
            }
        });
    </script>
</body>
</html>
