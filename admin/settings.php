<?php
include 'includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "includes/header.php" ?>
</head>
<body>
  <div class="d-flex w-100 w-full">
    <!-- Sidebar -->
    <?php include "includes/sidebar.php" ?>

    <!-- Main Content -->
    <div id="content" class="flex-grow-1">
      <!-- Top Navigation -->
      <?php include "includes/topnav.php" ?>

      <!-- Dashboard -->
      <div class="container-fluid mt-4">
        <!-- Service List Table -->
        <div class="row mt-4">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header bg-dark">
                <h5 class="card-title text-light">Reports</h5>
              </div>
              <div class="card-body">
                
              <div class="row mb-3">
                   
                    <div class="col-md-12">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($admin['firstname']); ?>" required oninput="validateName(this)">
                    </div>
                    <div class="col-md-12">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?= htmlspecialchars($admin['middlename']); ?>" required oninput="validateName(this)">
                    </div>
                    <div class="col-md-12">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($admin['lastname']); ?>" required oninput="validateName(this)">
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include "includes/footer.php" ?>




</body>
</html>
