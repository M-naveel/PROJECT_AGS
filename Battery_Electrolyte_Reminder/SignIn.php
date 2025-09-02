<?php
include "Header.php";
session_start();
// Start session to check if user is already logged in

// If logged in, redirect to index.php (or dashboard)
if (isset($_SESSION['username'])) {
    header("Location: Index.php");
    exit;
}
// include __DIR__ . "/Navbar.php";
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
<!-- <script>
    function Onlogin(){
    var u_name = document.getElementById("UserName").value.trim() ;
    var u_pass = document.getElementById("Password").value.trim() ;
    if (u_name === "Admin" && u_pass === "Admin" ){
        alert(`Welcome ${u_name}`);
    }
    else if(u_name === "User" && u_pass === "User" ){
        alert(`Welcome ${u_name}`);
    }
    else{
        alert("Invalid creditionals")
    }
}

</script> -->

<?php #include __DIR__. "/Footer.php";?>