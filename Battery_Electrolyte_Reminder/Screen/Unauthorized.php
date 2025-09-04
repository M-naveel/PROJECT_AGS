<?php
// No need for AuthCheck here, page is for error message only
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unauthorized</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg border-0 text-center" style="max-width: 500px; width: 100%;">
        <div class="card-body p-5">
            <h1 class="display-5 text-danger fw-bold">Unauthorized Access</h1>
            <p class="mt-3 text-muted">
                You do not have permission to view this page.
            </p>
            <a href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/userIndex.php" 
               class="btn btn-primary mt-4">
               Return to Dashboard
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
