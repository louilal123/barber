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

      <div class="container-fluid mt-4">

        <div class="row mt-4">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Appointment Reports</h5>
                <div class="d-flex justify-content-end mb-3 col-md-3">

                  <input type="month" class="form-control" id="filterMonthYear">
                  <button type="button" class="btn btn-primary ml-2" onclick="filterAppointments()">Filter</button>

                  <button type="button" class="btn btn-secondary ml-2 ms-end" onclick="printTable()">Print</button>
                </div>
                <table class="table" id="appointmentTable">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Contact</th>
                      <th>Email</th>
                      <th>Schedule Date</th>
                      <th>Status</th>
                      <th>Total(Pesos)</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>

                <div id="appointmentTotals" class="mt-3 text-end me-4" style="display:none;">
                  <strong>Total Amount: </strong><span id="totalAmount">0</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <?php include "includes/footer.php" ?>

    <script>
  function printTable() {
    // Get table data
    var tableContent = '';
    var rows = document.querySelectorAll('#appointmentTable tbody tr');
    let totalAmount = 0; // Variable to track total amounts

    rows.forEach(function(row) {
        tableContent += '<tr>';
        row.querySelectorAll('td').forEach(function(cell, index) {
            tableContent += '<td>' + cell.innerHTML + '</td>';
            if (index === 5) { // Assuming the "Total" column is the 6th column (0-based index)
                totalAmount += parseFloat(cell.innerText) || 0; // Add the total value
            }
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
                    .totals {
                        margin-top: 20px;
                        font-size: 16px;
                        font-weight: bold;
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

                <!-- Totals Section -->
                <div class="totals">
                    Total Amount: ₱${totalAmount.toFixed(2)}
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
  function filterAppointments() {
    var filterMonthYear = document.getElementById('filterMonthYear').value;
    
    if (!filterMonthYear) {
        alert("Please select a month and year to filter.");
        return;
    }

    var year = filterMonthYear.split("-")[0];
    var month = filterMonthYear.split("-")[1];

    // Make AJAX request to fetch the filtered appointments based on the selected month and year
    $.ajax({
        url: 'functions/filter_appointments.php',
        type: 'GET',
        data: { month: month, year: year },
        success: function(response) {
            var appointments = JSON.parse(response);

            // Clear previous table data
            $('#appointmentTable tbody').empty();
            $('#appointmentTotals').hide(); // Hide totals initially

            // Variables for calculating totals
            var totalAmount = 0;

            // Populate table with filtered data
            if (appointments.length > 0) {
                appointments.forEach(function(appointment) {
                    var row = '<tr>';
                    row += '<td>' + appointment.fullname + '</td>';
                    row += '<td>' + appointment.contact + '</td>';
                    row += '<td>' + appointment.email + '</td>';
                    row += '<td>' + appointment.schedule + '</td>';
                    row += '<td>' + (appointment.status == 1 ? 'Verified' : 'Unverified') + '</td>';
                    row += '<td>' + appointment.total + '</td>';
                    row += '</tr>';
                    $('#appointmentTable tbody').append(row);

                    // Update totals
                    totalAmount += parseFloat(appointment.total);
                });

                // Show totals
                $('#appointmentTotals').show();
                $('#totalAmount').text(totalAmount.toFixed(2));
            } else {
                $('#appointmentTable tbody').append('<tr><td colspan="6">No appointments found for the selected month and year.</td></tr>');
            }
        }
    });
}

 </script>

</body>
</html>
