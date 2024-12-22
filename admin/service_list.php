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
              <div class="card-header">
                <h5 class="card-title">List of Services</h5>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    Add New Service
                  </button>
                </div>
                <table class="table" id="myTable">
  <thead>
    <tr>
      <th>Service Name</th>
      <th>Description</th>
      <th>Cost</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include('functions/connection.php');
    
    $query = "SELECT * FROM service_list";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0):
      $services = $result->fetch_all(MYSQLI_ASSOC);
      foreach ($services as $service): ?>
        <tr>
          <td><?php echo htmlspecialchars($service['name'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?php echo htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?php echo number_format($service['cost'], 2); ?></td>
          <td>
  <?php if ($service['status'] == 1): ?>
    <span class="badge bg-success">Active</span>
  <?php else: ?>
    <span class="badge bg-secondary">Inactive</span>
  <?php endif; ?>
</td>

          <td>
            <button 
              type="button" 
              class="btn btn-success btn-sm editServiceBtn" 
              data-bs-toggle="modal" 
              data-bs-target="#editServiceModal" 
              data-id="<?php echo $service['id']; ?>"
              data-name="<?php echo htmlspecialchars($service['name'], ENT_QUOTES, 'UTF-8'); ?>"
              data-description="<?php echo htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8'); ?>"
              data-cost="<?php echo $service['cost']; ?>"
              data-status="<?php echo $service['status']; ?>">
              Edit
            </button>

            <button 
              type="button" 
              class="btn btn-danger btn-sm deleteServiceBtn" 
              data-id="<?php echo $service['id']; ?>">
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
  </div>

  <?php include "includes/footer.php" ?>

  <!-- Modal for Adding New Service -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="functions/add_service.php">
          <div class="mb-3">
            <label for="serviceName" class="form-label">Service Name</label>
            <input type="text" class="form-control" id="serviceName" name="name" required oninput="validateServiceName('serviceName')">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required oninput="validateDescription('description')"></textarea>
          </div>
          <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="number" class="form-control" id="cost" name="cost" required>
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="add_service" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal for Editing Service -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="functions/edit_service.php">
          <input type="hidden" id="editServiceId" name="id">
          <div class="mb-3">
            <label for="editServiceName" class="form-label">Service Name</label>
            <input type="text" class="form-control" id="editServiceName" name="name" required oninput="validateServiceName('editServiceName')">
          </div>
          <div class="mb-3">
            <label for="editDescription" class="form-label">Description</label>
            <textarea class="form-control" id="editDescription" name="description" required oninput="validateDescription('editDescription')"></textarea>
          </div>
          <div class="mb-3">
            <label for="editCost" class="form-label">Cost</label>
            <input type="number" class="form-control" id="editCost" name="cost" required>
          </div>
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select class="form-select" id="editStatus" name="status" required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


  <script>
  // Function to validate Service Name input (only alphabets and spaces)
  function validateServiceName(id) {
    var input = document.getElementById(id);
    var value = input.value;
    // Remove any non-alphabetical characters (including numbers and special chars)
    input.value = value.replace(/[^A-Za-z\s]/g, '');
  }

  // Function to validate Description input (only alphabets and spaces)
  function validateDescription(id) {
    var input = document.getElementById(id);
    var value = input.value;
    // Remove any non-alphabetical characters (including numbers and special chars)
    input.value = value.replace(/[^A-Za-z\s]/g, '');
  }
</script>

  <script>
    $(document).ready(function () {
      $('.editServiceBtn').on('click', function () {
        const serviceId = $(this).data('id');
        const serviceName = $(this).data('name');
        const description = $(this).data('description');
        const cost = $(this).data('cost');
        const status = $(this).data('status');

        $('#editServiceId').val(serviceId);
        $('#editServiceName').val(serviceName);
        $('#editDescription').val(description);
        $('#editCost').val(cost);
        $('#editStatus').val(status);
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('.deleteServiceBtn').on('click', function (e) {
        e.preventDefault();
        const serviceId = $(this).data('id');

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
            window.location.href = `functions/delete_service.php?id=${serviceId}`;
          }
        });
      });
    });
  </script>

</body>
</html>
