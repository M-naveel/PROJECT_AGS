<?php

include "DatabaseCon.php";
$DeletedAt = 0;
$DeletedBy = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Cust_name   = $_POST['Customer_Name'];
    $Phone       = $_POST['Phone_Number'];
    $Email       = $_POST['Email'];
    $Battery     = $_POST['Battery_Model'];
    $UpdatedBy   = $_POST['Updated_By'];
    $UpdatedAt   = $_POST['Updated_At'];
    $SaleDate    = $_POST['Sale_Date'];
    $Stat    = $_POST['Status'];


   $Sql = "INSERT INTO sale(Customer_Name, Phone_Number,Email,Sale_Date,batteryids,Deleted_At,Deleted_By,Last_Updated_At,Last_Updated_By,Status_bar) VALUES(?,?,?,?,?,?,?,?,?,?)";
    $Add = $conn->prepare($Sql);
      $Add->bind_param("ssssssssss",$Cust_name,$Phone,$Email,$SaleDate,$Battery,$DeletedAt,$DeletedBy,$UpdatedAt,$UpdatedBy,$Stat);
     if ($Add->execute()){
      echo "<script>alert(`Data is inserted`)</script>";
    }
    else{
      echo "Error" .$Add->error;
    }
    $Add->close();
    $conn->close();
    

  }