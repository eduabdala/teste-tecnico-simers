<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Simers | User Manager</title>
    <!-- Favicon for the webpage -->
    <link rel="icon" href="https://simers.org.br/img/simers-icon.png" type="image/png">
    
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom stylesheet for additional page styling -->
    <link rel="stylesheet" href="css/simers-theme.css">
    
    <style>
        /* Custom theme colors */
        :root {
            --simers-green: #007a3d; /* Simers primary green */
            --simers-light-green: #e6f4ef; /* Light green background color */
            --simers-dark: #004d29; /* Simers dark green */
        }

        /* Set background color for the body */
        body {
            background-color: var(--simers-light-green);
        }

        /* Styling for the hero section */
        .hero {
            background-color: white;
            padding: 4rem 2rem;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 4rem;
        }

        /* Styling for the Simers themed button */
        .btn-simers {
            background-color: var(--simers-green);
            color: white;
            border: none;
        }

        /* Hover effect for Simers button */
        .btn-simers:hover {
            background-color: var(--simers-dark);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero section welcoming the user -->
        <div class="hero">
            <h1 class="mb-3">Welcome to <strong>Simers User Manager</strong> 👋</h1>
            <p class="mb-4 text-muted">Manage users quickly and easily.</p>
            
            <!-- Button to create a new user -->
            <a href="?action=create" class="btn btn-simers me-2">+ Create New User</a>
            
            <!-- Button to list all users -->
            <a href="?action=readAll" class="btn btn-outline-success">📋 List Users</a>
        </div>
    </div>
</body>
</html>
