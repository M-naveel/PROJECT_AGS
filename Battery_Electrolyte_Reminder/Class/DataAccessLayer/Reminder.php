Filter code  
 
   


 <div class="container mt-5">
 <form method="GET" class="row g-3 mb-4 Adjust_screen">
    <div class="col-md-4">
        <input type="text" name="customer" class="form-control" 
               placeholder="Search by Customer Name" 
               value="<?=  htmlspecialchars($_GET['customer'] ?? '') ?>">
    </div>
    

    
    <div class="col-md-3">
        <select name="battery" class="form-select">
            <option value="">All Batteries</option>
            <?php
             $batteryRes = $conn->query("SELECT Id, Model_Name FROM battery WHERE is_deleted = 0");
             while ($b = $batteryRes->fetch_assoc()):
                 $selected = ($_GET['battery'] ?? '') == $b['Id'] ? 'selected' : '';
            ?>
                <option value="<?= $b['Id'] ?>" <?=  $selected ?>><?=  htmlspecialchars($b['Model_Name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="col-md-3">
        <input type="date" name="date" class="form-control" 
               value="<?= htmlspecialchars($_GET['date'] ?? '') ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
    </div>
</form>
</div>