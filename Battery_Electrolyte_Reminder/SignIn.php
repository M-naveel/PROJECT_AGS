<?php
include "header.php";
session_start();

// If logged in, redirect to index.php (or dashboard)
if (isset($_SESSION['username'])) {
    header("Location: Index.php");
    exit;
}
?>

<div class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow-lg rounded-4 p-4" style="width: 380px;">
        <form action="login_handler.php" method="POST">
            <fieldset>
                <legend class="text-center mb-4 fw-bold text-Dark">Login</legend>
                
                <!-- Username -->
                <div class="mb-3">
                    <label for="UserName" class="form-label">User Name</label>
                    <input type="text" id="UserName" name="UserName" class="form-control" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" id="Password" name="Password" class="form-control" required>
                </div>

                <!-- Remember me & Forgot -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <a href="#" class="text-decoration-none small text-primary">Forgot password?</a>
                </div>

                <!-- Submit button -->
                <div>
                    <button type="submit" class="btn btn-dark w-100 rounded-pill" onclick="Onlogin()">
                        Login
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php #include __DIR__. "/Footer.php";?>
