<?php
include "header.php";
session_start();
// Start session to check if user is already logged in

// If logged in, redirect to index.php (or dashboard)
if (isset($_SESSION['username'])) {
    header("Location: Index.php");
    exit;
}
// include __DIR__ . "/navbar.php";
?>
<form action="login_handler.php" method="POST">
    <fieldset>
        <legend>Logins</legend>
        
<div class="container mt-5 Adjust_Screen ">
    
   <div class="mb-3">
            <label for="UserName" class="form-label">User Name</label>
            <input type="text" id="UserName" name="UserName" class="form-control"  required>
        </div>

    <div class=" mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="Password" id="Password" name="Password" class="form-control"  required>
    </div>
    <div>
        <button type="Submit" onclick="Onlogin()">
            Submit
        </button>
    </div>
</div>

</fieldset>
</form>
<?php #include __DIR__. "/Footer.php";?>