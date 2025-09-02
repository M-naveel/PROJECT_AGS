<?php 
$pageTitle ="Add Form";
<<<<<<< Updated upstream
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
=======
$pagename ="Dispa";

include "DatabaseCon.php"; // your DB connection

$sql = "SELECT c.*, b.Model_Name
        FROM customers c
        JOIN battery b ON c.Battery_ID = b.Id
        WHERE c.is_deleted = 0
          AND DATEDIFF(CURDATE(), c.Sale_Date) % 15 = 0";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Electrolyte Reminder Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Battery Electrolyte Due Today</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Battery Model</th>
                <th>Sale Date</th>
                <th>Days Since Sale</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Customer_Name']); ?></td>
                        <td><?= htmlspecialchars($row['Phone_Number']); ?></td>
                        <td><?= htmlspecialchars($row['Email']); ?></td>
                        <td><?= htmlspecialchars($row['Model_Name']); ?></td>
                        <td><?= htmlspecialchars($row['Sale_Date']); ?></td>
                        <td><?= floor((strtotime(date('Y-m-d')) - strtotime($row['Sale_Date'])) / 86400); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No batteries due today.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>



>>>>>>> Stashed changes
<?php include "../Footer.php"?>
