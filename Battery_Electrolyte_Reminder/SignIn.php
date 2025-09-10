<?php
$pageTitle= "Electrolyte Refil Reminder";

session_start();
include "header.php";

// If logged in, redirect to dashboard
if (isset($_SESSION['username'])) {
    header("Location: Index.php");
    exit;
}
?>

<div class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow-lg rounded-4 border-0" style="width: 380px;">
        
        <!-- Card Header -->
        <div class="card-header text-center bg-dark text-white rounded-top-4">
            <h3 class="fw-bold mb-0">🔋 Electrolyte Refill Reminder</h3>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">
            <form action="login_handler.php" method="POST">
                <fieldset>
                    <legend class="text-center mb-4 fw-bold text-dark">Login</legend>
                    
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="UserName" class="form-label">User Name</label>
                        <input 
                            type="text" 
                            id="UserName" 
                            name="UserName" 
                            class="form-control" 
                            placeholder="Enter your username" 
                            required
                        >
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            id="Password" 
                            name="Password" 
                            class="form-control" 
                            placeholder="Enter your password" 
                            required
                        >
                    </div>

                    <!-- Remember me & Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="rememberMe" 
                                name="rememberMe"
                            >
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none small text-primary">Forgot password?</a>
                    </div>

                    <!-- Submit button -->
                    <div>
                        <button 
                            type="submit" 
                            class="btn btn-dark w-100 rounded-pill"
                        >
                            Login
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
