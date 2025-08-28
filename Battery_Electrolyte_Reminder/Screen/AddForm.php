<?php 
$pageTitle ="Add Form";
$pagename ="Add Form";

include __DIR__ . "/../Navbar.php";
?>//__DIR__

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />  // Add Link In Header


  <!-- Bootstrap CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" /> -->




<!-- Main content area with left margin to avoid sidebar overlap -->
<div style="margin-left: 270px; padding: 20px; ">
  <div class="container mt-4">
    <h4>Add User</h4>
    <form>
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              placeholder="Enter full name"
              required
            />
          </div>
          <div class="mb-3">
            <label for="id" class="form-label">ID*</label>
             <input  
              type="text"
              class="form-control"
              id="id"
              placeholder="Enter ID"
              required
            />
          </div>
        </div>
        <div class="col">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Enter email"
            />
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input
              type="tel"
              class="form-control"
              id="phone"
              placeholder="Enter phone number"
              required
            />
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      
    </form>
  </div>
</div>

<
<?php include "../Footer.php"?>
