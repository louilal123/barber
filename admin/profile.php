<?php
include 'includes/session.php';

// Fetch the admin's current profile
// include 'functions/connection.php';
// $query = "SELECT id, firstname, middlename, lastname, username, avatar, last_login FROM users WHERE id = 1 LIMIT 1"; // Change id to your session id dynamically
// $result = $conn->query($query);
// $admin = $result->fetch_assoc();
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

      <!-- Profile Information -->
      <div class="container-fluid mt-4">
        <div class="row mt-4">
          <div class="col-lg-8 mx-auto">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Admin Profile</h5>
              </div>
              <div class="card-body">
                <!-- Profile Update Form -->
                <form method="POST" action="functions/update_profile.php" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="d-flex ms-auto">
                        <img src="uploads/<?= htmlspecialchars($admin['avatar']); ?>" alt="" srcset="" style="display: flex; margin: auto; border-radius: 100%; height: 200px; width: 300px;">
                    </div>
                    <div class="col-md-12">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($admin['firstname']); ?>"  oninput="validateName(this)">
                    </div>
                    <div class="col-md-12">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?= htmlspecialchars($admin['middlename']); ?>"  oninput="validateName(this)">
                    </div>
                    <div class="col-md-12">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($admin['lastname']); ?>"  oninput="validateName(this)">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($admin['username']); ?>" >
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label">New Avatar</label>
                    <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                </div>

                <!-- Buttons -->
                <div class="text-end">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 <!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="functions/change_password.php">
        <div class="modal-body">
          <!-- Current Password -->
          <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" >
          </div>
          <!-- New Password -->
          <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password"  minlength="8">
          </div>
          <!-- Confirm New Password -->
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
      </form>
    </div>
  </div>
</div>


  <?php include "includes/footer.php" ?>

  <!-- JavaScript Validation -->
  <script>
    // Name Validation: Allow only alphabets and spaces
    function validateName(input) {
      input.value = input.value.replace(/[^A-Za-z\s]/g, '');
    }

    // Password Validation
    function validatePasswordForm() {
      const newPassword = document.getElementById('newPassword').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      const error = document.getElementById('passwordError');
      
      if (newPassword !== confirmPassword) {
        error.classList.remove('d-none');
        return false;
      } else {
        error.classList.add('d-none');
        return true;
      }
    }
  </script>

</body>
</html>
