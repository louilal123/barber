<?php
include 'includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "includes/header.php"; ?>
</head>
<body>
  <div class="d-flex w-100 w-full">
    <!-- Sidebar -->
    <?php include "includes/sidebar.php"; ?>

    <!-- Main Content -->
    <div id="content" class="flex-grow-1">
      <!-- Top Navigation -->
      <?php include "includes/topnav.php"; ?>

      <!-- Dashboard -->
      <div class="container-fluid mt-4">

        <!-- Room Types Table -->
        <div class="row mt-4">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List of Admins</h5>
                <div class="d-flex justify-content-end mb-3">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                    Add New Admin
                  </button>
                </div>
                <table class="table" id="myTable">
                  <thead>
                    <tr>
                      <th>Photo</th>
                      <th>Full Name</th>
                      <th>Username</th>
                      <th>Type</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include('functions/connection.php');

                    // Query updated to fetch the correct columns
                    $query = "SELECT id, firstname, middlename, lastname, username, avatar, type, status, date_added, date_updated FROM users where type!=1";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0):
                      $admins = $result->fetch_all(MYSQLI_ASSOC);
                      foreach ($admins as $admin): ?>
                        <tr>
                          <td><img src="uploads/<?php echo htmlspecialchars($admin['avatar']); ?>" alt="Admin Avatar" width="50"></td>
                          <td><?php echo htmlspecialchars($admin['firstname'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($admin['middlename'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($admin['lastname'], ENT_QUOTES, 'UTF-8'); ?></td>
                          <td><?php echo htmlspecialchars($admin['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                          
                          <td>Administrator</td>
                          
                          <td>
                            <button type="button" class="btn btn-success btn-sm editAdminBtn" data-bs-toggle="modal" data-bs-target="#editAdminModal"
                              data-id="<?php echo $admin['id']; ?>"
                              data-firstname="<?php echo htmlspecialchars($admin['firstname'], ENT_QUOTES, 'UTF-8'); ?>"
                              data-middlename="<?php echo htmlspecialchars($admin['middlename'], ENT_QUOTES, 'UTF-8'); ?>"
                              data-lastname="<?php echo htmlspecialchars($admin['lastname'], ENT_QUOTES, 'UTF-8'); ?>"
                              data-username="<?php echo htmlspecialchars($admin['username'], ENT_QUOTES, 'UTF-8'); ?>"
                             
                              data-avatar="<?php echo htmlspecialchars($admin['avatar'], ENT_QUOTES, 'UTF-8'); ?>">
                              Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm deleteAdminBtn" data-id="<?php echo $admin['id']; ?>">
                              Delete
                            </button>
                          </td>
                        </tr>
                      <?php endforeach;
                    endif;
                    ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <?php include "includes/footer.php"; ?>

    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="functions/edit_admin.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="editAdminId" name="id">
          <div class="mb-3">
            <label for="editFullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="editFullname" name="fullname" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed">
          </div>
          <div class="mb-3">
            <label for="editUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="editUsername" name="username" required pattern="[A-Za-z0-9_]+" title="Only letters, numbers, and underscores are allowed">
          </div>
          <div class="mb-3">
            <label for="editAvatar" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="editAvatar" name="avatar" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>


  </div>

<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAdminModalLabel">Add New Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="functions/add_admin.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
          </div>
          <div class="mb-3">
            <label for="middlename" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middlename" name="middlename" required>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary">Add Admin</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
  $(document).ready(function () {
  $('.editAdminBtn').on('click', function () {
    const adminId = $(this).data('id');
    const firstname = $(this).data('firstname');
    const middlename = $(this).data('middlename');
    const lastname = $(this).data('lastname');
    const username = $(this).data('username');

    // Populate the modal fields
    $('#editAdminId').val(adminId);
    $('#editFullname').val(firstname + ' ' + middlename + ' ' + lastname);
    $('#editUsername').val(username);
  });

  $('.deleteAdminBtn').on('click', function (e) {
    e.preventDefault();
    const adminId = $(this).data('id');

    Swal.fire({
      title: 'Are you sure?',
      text: 'This action cannot be undone!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `functions/delete_admin.php?id=${adminId}`;
      }
    });
  });
});

</script>

</body>
</html>
