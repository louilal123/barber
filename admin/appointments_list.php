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
      <div class="container-fluid mt-4 ">

        <div class="row mt-4">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Appointments List</h5>
              </div>
              <div class="card-body">
               
              <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th>Fullname</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Schedule Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('functions/connection.php');

                  $query = "SELECT * FROM appointment_list";
                  $result = $conn->query($query);

                  if ($result->num_rows > 0):
                    $appointments = $result->fetch_all(MYSQLI_ASSOC);
                    foreach ($appointments as $appointment): ?>
                      <tr>
                        <td><?php echo htmlspecialchars($appointment['fullname'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($appointment['contact'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($appointment['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($appointment['schedule'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                          <?php 
                          if ($appointment['status'] == '0') {
                              echo '<span class="badge bg-secondary">Unverified</span>';
                          } else {
                              echo '<span class="badge bg-success">Verified</span>';
                          }
                          ?>
                        </td>
                        <td><?php echo number_format($appointment['total'], 2); ?></td>
                        <td>
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
      Actions
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <!-- Verify Button -->
      <?php if ($appointment['status'] == '0'): ?>
        <li>
          <form method="POST" action="functions/update_appointment_status.php" style="display: inline;">
            <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
            <input type="hidden" name="status" value="1">
            <button type="submit" class="dropdown-item">Verify</button>
          </form>
        </li>
      <?php endif; ?>

      <!-- Unverify Button -->
      <?php if ($appointment['status'] == '1'): ?>
        <li>
          <form method="POST" action="functions/update_appointment_status.php" style="display: inline;">
            <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
            <input type="hidden" name="status" value="0">
            <button type="submit" class="dropdown-item">Unverify</button>
          </form>
        </li>
      <?php endif; ?>

      <!-- View Button -->
      <li>
        <button 
          type="button" 
          class="dropdown-item viewAppointmentBtn" 
          data-bs-toggle="modal" 
          data-id="<?php echo $appointment['id']; ?>" 
          data-bs-target="#viewAppointmentModal">
          View
        </button>
      </li>

      <!-- Delete Button -->
      <li>
      <button 
                              type="button" 
                              class="dropdown-item
                       deleteAppointmentBtn ml-2" 
                              data-id="<?php echo $appointment['id']; ?>"
                              onclick="deleteAppointment(<?php echo $appointment['id']; ?>)">
                              Delete
      </li>
    </ul>
  </div>
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

  <?php include "includes/footer.php" ?>
 <!-- Modal -->
 <div class="modal fade" id="viewAppointmentModal" tabindex="-1" aria-labelledby="viewAppointmentModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewAppointmentModalLabel">Appointment Details</h5>
           
          </div>
          <div class="modal-body" id="printableContent">
            <div class="row">
              <div class="col-md-6">
                <p><strong>Full Name:</strong> <span id="modalFullname"></span></p>
                <p><strong>Contact:</strong> <span id="modalContact"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
              </div>
              <div class="col-md-6">
                <p><strong>Schedule:</strong> <span id="modalSchedule"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                
              </div>
            </div>
            <hr>
            <h5>Services</h5>
            <table class="table table-bordered" id="servicesTable">
              <thead>
                <tr>
                  <th>Service Name</th>
                  <th>Cost</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
            <h3 class="text-end me-4"><strong>Total:</strong> <span id="modalTotal"></span>.00</h3>
          </div>
          <div></div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-close"></i> Close</button>
            <button class="btn btn-danger" id="printModalContent"><i class="fas fa-print"></i> Print</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  $(document).ready(function () {
    $('#printModalContent').on('click', function () {
      const content = document.getElementById('printableContent').innerHTML; // Get modal content

      // Get the current date
      const currentDate = new Date();
      const formattedDate = currentDate.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });

      // Open a new window for printing
      const printWindow = window.open('', '_blank', 'height=600,width=800');
      
      // Write content to the print window
      printWindow.document.write(`
        <html>
          <head>
            <title>Appointment Details</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
            <style>
              body {
                font-family: Arial, sans-serif;
                margin: 20px;
              }
              .header-title {
                color:rgb(29, 151, 182);
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 5px;
                text-align: center;
              }
              .sub-header {
                font-size: 16px;
                text-align: center;
                margin-bottom: 10px;
              }
              .date {
                font-size: 14px;
                text-align: center;
                margin-bottom: 20px;
              }
            </style>
          </head>
          <body>
            <!-- Header Section -->
            <div class="header-title">Barbershop Booking Appointment System</div>
            <div class="sub-header">Poblacion, Madridejos, Cebu</div>
            <div class="date">Date: ${formattedDate}</div>

            <!-- Appointment Content -->
            <div id="content-section">
              ${content}
            </div>
          </body>
        </html>
      `);

      printWindow.document.close(); // Close the document
      printWindow.print(); // Trigger the print
    });
  });
</script>

  <script>
    $(document).ready(function () {
      $('.viewAppointmentBtn').on('click', function () {
        const appointmentId = $(this).data('id');

        // Fetch data using AJAX
        $.ajax({
          url: 'functions/get_appointment_details.php',
          type: 'GET',
          data: { id: appointmentId },
          dataType: 'json',
          success: function (response) {
            // Populate appointment details
            $('#modalFullname').text(response.appointment.fullname);
            $('#modalContact').text(response.appointment.contact);
            $('#modalEmail').text(response.appointment.email);
            $('#modalSchedule').text(response.appointment.schedule);
            $('#modalStatus').text(
              response.appointment.status == 1 
                ? 'Verified' 
                : 'Pending'
            );
            $('#modalTotal').text(response.appointment.total);

            // Populate services table
            const servicesTable = $('#servicesTable tbody');
            servicesTable.empty(); // Clear existing rows
            response.services.forEach(service => {
              const row = `
                <tr>
                  <td>${service.service_name}</td>
                  <td>${parseFloat(service.cost).toFixed(2)}</td>
                </tr>
              `;
              servicesTable.append(row);
            });
          },
        });
      });
    });

    function printTable() {
    // Get table data
    var tableContent = '';
    var rows = document.querySelectorAll('#appointmentTable tbody tr');
    
    rows.forEach(function(row) {
        tableContent += '<tr>';
        row.querySelectorAll('td').forEach(function(cell) {
            tableContent += '<td>' + cell.innerHTML + '</td>';
        });
        tableContent += '</tr>';
    });

    // Get the current date
    const currentDate = new Date();
    const formattedDate = currentDate.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });

    // Open a new window for printing
    const printWindow = window.open('', '_blank', 'height=600,width=800');
    
    // Write content to the print window
    printWindow.document.write(`
        <html>
            <head>
                <title>Appointment Details</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                    }
                    .header-title {
                        color: rgb(29, 151, 182);
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 5px;
                        text-align: center;
                    }
                    .sub-header {
                        font-size: 16px;
                        text-align: center;
                        margin-bottom: 10px;
                    }
                    .date {
                        font-size: 14px;
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                </style>
            </head>
            <body>
                <!-- Header Section -->
                <div class="header-title">Barbershop Booking Appointment System</div>
                <div class="sub-header">Poblacion, Madridejos, Cebu</div>
                <div class="date">Date: ${formattedDate}</div>

                <!-- Appointment Content -->
                <div id="content-section">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tableContent}
                        </tbody>
                    </table>
                </div>
            </body>
        </html>
    `);

    // Close the document and trigger print
    printWindow.document.close();
    printWindow.print();
}

  </script>
<script>
  $(document).ready(function () {
    $('.deleteAppointmentBtn').on('click', function (e) {
      e.preventDefault();
      const appointmentId = $(this).data('id'); // Get the appointment ID

      // Show SweetAlert confirmation dialog
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
          // Send request to delete appointment
          window.location.href = `functions/delete_appointment.php?id=${appointmentId}`;
        }
      });
    });
  });
</script>


</body>
</html>
