<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Theme CSS -->
    <link rel="stylesheet" href="css/simers-theme.css">
</head>
<body class="p-4 bg-light text-dark">
    <div class="container">
        <h1 class="mb-4 text-success">✏️ Edit User</h1>

        <!-- Form to edit the user details -->
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
                <label for="data_nascimento" class="form-label">Date of Birth</label>
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
                <!-- Submit button to update the user -->
                <button type="submit" class="btn btn-simers">
                    <i class="bi bi-check-circle"></i> Update
                </button>
                <!-- Button to go back -->
                <a href="?action=readAll" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>
    
    <script>
        // JavaScript to validate form fields before submission
        document.getElementById('userForm').addEventListener('submit', function (event) {
            const name = document.getElementById('name').value.trim();
            const cpf = document.getElementById('cpf').value.trim();
            const email = document.getElementById('email').value.trim();
            const birthDate = document.getElementById('birth_date').value;
            const phone = document.getElementById('phone').value.trim();
            const password = document.getElementById('password').value;

            const nameRegex = /^[A-Za-zÀ-ÿ\s]+$/; // Regex to allow only letters and spaces for the name
            const cpfRegex = /^\d{11}$/; // CPF should be 11 digits
            const phoneRegex = /^\d{10,11}$/; // Phone should be 10 or 11 digits
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email validation regex

            // Validate name
            if (!nameRegex.test(name)) {
                alert("Name must contain only letters and spaces.");
                event.preventDefault();
                return;
            }

            // Validate CPF (must be exactly 11 digits)
            if (!cpfRegex.test(cpf)) {
                alert("CPF must contain exactly 11 digits.");
                event.preventDefault();
                return;
            }

            // Validate email format
            if (!emailRegex.test(email)) {
                alert("Invalid email format.");
                event.preventDefault();
                return;
            }

            // Check if birth date is filled
            if (!birthDate) {
                alert("Date of birth is required.");
                event.preventDefault();
                return;
            }

            // Validate phone number length (should be 10 or 11 digits)
            if (!phoneRegex.test(phone)) {
                alert("Phone number should contain between 10 and 11 digits.");
                event.preventDefault();
                return;
            }

            // Check if password length is at least 6 characters (if password is provided)
            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                event.preventDefault();
                return;
            }
        });
    </script>
</body>
</html>
