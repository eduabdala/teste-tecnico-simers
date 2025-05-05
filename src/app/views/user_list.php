<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme CSS -->
    <link rel="stylesheet" href="css/simers-theme.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="p-4 bg-light text-dark">
    <div class="container">
        <h1 class="mb-4 text-success">👥 Registered Users</h1>
        <div class="mb-3 d-flex gap-2">
            <!-- Link to create a new user -->
            <a href="?action=create" class="btn btn-simers">
                <i class="bi bi-plus-circle"></i> Create User
            </a>
            <!-- Link to go back -->
            <a href="?action=index" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <!-- Check if the users array is empty -->
        <?php if (empty($users)): ?>
            <!-- Alert message when no users are found -->
            <div class="alert alert-warning">No users found.</div>
        <?php else: ?>
            <!-- Table displaying the list of users -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th>Name</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through each user and display their details in a table row -->
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars($user['cpf']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['birth_date']) ?></td>
                                <td><?= htmlspecialchars($user['phone']) ?></td>
                                <td class="text-center">
                                    <!-- Edit button -->
                                    <a href="?action=edit&id=<?= $user['id'] ?>" class="btn btn-outline-success btn-sm me-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <!-- Delete button with confirmation -->
                                    <a href="?action=delete&id=<?= $user['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="bi bi-trash"></i> Delete
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
