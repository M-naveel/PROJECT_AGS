<?php 
$pageTitle ="Warranty Form";
$pagename ="Warranty Form";

include __DIR__ . "/../Navbar.php";
?>


    <div class="container " style>
      <form action="record.php" method="post">
      <h1 class="mt-5">Warranty_Form</h1>
      <div class="row">
        <div class="col-6">  <div class="mb-3">
          <label for="Warranry No" class="form-label"
            >Warranry_No</label
          >
          <input
            type="text"
            class="form-control"
            id="Warranry_No"
            placeholder="Warranry_No"
          />
        </div>
      </div>
        <div class="col-6">
            <div class="mb-3">
          <label for="Warranty_start_date" class="form-label"
            >Warranty_start_date</label
          >
          <input
            type="Datetime"
            class="form-control"
            id="Warranty_start_date"
            placeholder="Warranty_start_date"
          />
          
        </div>
      
        </div>
      </div>

      <div class="row">
        <div class="col-6">
        <div class="mb-3">
          <label for="Battery_Code" class="form-label"
            >Battery Code</label
          >
          <input
            type="text"
            class="form-control"
            id="Battery_Code"
            placeholder="Battery_Code"
          />
          
        </div>
        
        </div>
        <div class="col-6">
            <div class="mb-3">
          <label for="Deleted_By" class="form-label"
            >Deleted By</label
          >
          <input
            type="text"
            class="form-control"
            id="Deleted_By"
            placeholder="Deleted_By"
          />
          
        </div>
        </div>
      </div>

<div class="row">
  <div class="col-6">
       <div class="mb-3">
          <label for="Updated_By" class="form-label"
            >Updated By</label
          >
          <input
            type="text"
            class="form-control"
            id="Updated_By"
            placeholder="Updated_By"
          />
          
        </div>
  </div>
  <div class="col-6">
    
                       <div class="mb-3">
          <label for="Deleted_At" class="form-label"
            >Deleted At</label
          >
          <input
            type="datetime-local"
            class="form-control"
            id="Deleted_At"
            
          />
          
        </div>

        
  </div>
</div>
<div class="row">
  <div class="col-6">
                   <div class="mb-3">
          <label for="Updated_At" class="form-label"
            >Updated At</label
          >
          <input
            type="datetime-local"
            class="form-control"
            id="Updated_At"
            
          />
          
        </div>

  </div>
  <div class="col-6">
    <div class="mb-3">
        <label for="status" class="form-label" >Status</label>
        <select class="form-select"  id="status" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="Active">Active</option>
  <option value="InActive">InActive</option>
  
</select>
</div>

  </div>
</div>


      <div class="form">
              

                     

<button type="submit" class="btn btn-primary mt-3">Submit</button>
      </div>
    </div>
    </form>
<?php include "../Footer.php"?>

