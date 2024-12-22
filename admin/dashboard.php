<?php include "includes/session.php"?>
<?php
include 'functions/connection.php';

// Fetch user count
$userQuery = "SELECT COUNT(id) AS userCount FROM users";
$userResult = $conn->query($userQuery);
$userCount = ($userResult && $userResult->num_rows > 0) ? $userResult->fetch_assoc()['userCount'] : 0;

// Fetch service count
$serviceQuery = "SELECT COUNT(id) AS serviceCount FROM service_list";
$serviceResult = $conn->query($serviceQuery);
$serviceCount = ($serviceResult && $serviceResult->num_rows > 0) ? $serviceResult->fetch_assoc()['serviceCount'] : 0;

// Fetch appointment count
$appointmentQuery = "SELECT COUNT(id) AS appointmentCount FROM appointment_list";
$appointmentResult = $conn->query($appointmentQuery);
$appointmentCount = ($appointmentResult && $appointmentResult->num_rows > 0) ? $appointmentResult->fetch_assoc()['appointmentCount'] : 0;

// Fetch total income
$incomeQuery = "SELECT SUM(total) AS totalIncome FROM appointment_list WHERE status='1' ";
$incomeResult = $conn->query($incomeQuery);
$totalIncome = ($incomeResult && $incomeResult->num_rows > 0) ? $incomeResult->fetch_assoc()['totalIncome'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "includes/header.php" ?>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <div class="d-flex w-100 w-full">
    <!-- Sidebar -->
    <?php include "includes/sidebar.php" ?>

    <!-- Main Content -->
    <div id="content" class="flex-grow-1 ">
      <!-- Top Navigation -->
      <?php include "includes/topnav.php" ?>

      <!-- Dashboard -->
      <div class="container-fluid mt-4">
        <h1 class="mb-4">Welcome <?php echo htmlspecialchars($admin_username) ?></h1>

        <div class="row">

         <!-- Box 4: Total Income -->
  <div class="col-xxl-3 col-md-6">
    <div class="card card1 text-dark h-100 shadow-sm">
      <div class="card-body d-flex align-items-center">
        <div class="ps-3">
          <h6 class="card-title ">Total Income</h6>
          <h1 class=" text">₱ <?php echo number_format($totalIncome, 2); ?></h1>
        </div>
        <div class="card-icon ms-auto">
          <i class="icon fas fa-coins"></i>
        </div>
      </div>
    </div>
  </div>


  <!-- Box 2: Services -->
  <div class="col-xxl-3 col-md-6">
    <div class="card card1 text-dark h-100 shadow-sm">
      <div class="card-body d-flex align-items-center">
        <div class="ps-3">
          <h6 class="card-title text- ">Services</h6>
          <h1 class=""><?php echo $serviceCount; ?></h1>
        </div>
        <div class="card-icon ms-auto">
          <i class="icon fas fa-concierge-bell "></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Box 3: Appointments -->
  <div class="col-xxl-3 col-md-6">
    <div class="card card1 text-dark h-100 shadow-sm">
      <div class="card-body d-flex align-items-center">
        <div class="ps-3">
          <h6 class="card-title text-">Appointments</h6>
          <h1 class=""><?php echo $appointmentCount; ?></h1>
        </div>
        <div class="card-icon ms-auto">
          <i class="icon fas fa-calendar-check"></i>
        </div>
      </div>
    </div>
  </div>

    <!-- Box 1: Users -->
    <div class="col-xxl-3 col-md-6">
      <div class="card card1 text-dark h-100 shadow-sm">
        <div class="card-body d-flex align-items-center">
          <div class="ps-3">
            <h6 class="card-title text-">Users</h6>
            <h1 class=""><?php echo $userCount; ?></h1>
          </div>
          <div class="card-icon ms-auto">
            <i class="icon fas fa-users"></i>
          </div>
        </div>
      </div>
    </div>

 
</div>
</div>


        <div class="row mt-4">

     <div class="col-md-12">
      <div class="container-fluid">
     <div class="card">
      <div class="card-body">
      <h5>Verified vs Unverified Appointments (Last 30 Days)</h5>
      <div class="id" id="chart"></div>
      </div>
     </div>
     
      </div>
     </div>
  

     </div>

      </div>
    </div>
  </div>

  <?php include "includes/footer.php" ?>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Fetch data from the backend
    fetch('functions/fetch_appointment_stats.php')
    .then(response => response.json())
        .then(data => {
            // Define month names
            const monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June', 
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            // Extract categories (months) and series data
            const categories = data.map(item => monthNames[item.month - 1]); // X-axis: Months
            const verifiedSeries = data.map(item => item.verified); // Verified counts
            const unverifiedSeries = data.map(item => item.unverified); // Unverified counts

            // ApexCharts options
            const options = {
                series: [
                    {
                        name: "Verified Appointments",
                        data: verifiedSeries
                    },
                    {
                        name: "Non-Verified Appointments",
                        data: unverifiedSeries
                    }
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.5
                    },
                    zoom: { enabled: false },
                    toolbar: { show: false }
                },
                colors: ['#77B6EA', '#FF4560'], // Blue for verified, red for unverified
                dataLabels: { enabled: true },
                stroke: { curve: 'smooth' },
                title: {
                    text: 'Appointments: Verified vs Non-Verified (Current Year)',
                    align: 'left'
                },
                grid: {
                    borderColor: '#e7e7e7',
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // Alternating row colors
                        opacity: 0.5
                    }
                },
                markers: { size: 1 },
                xaxis: {
                    categories: categories, // X-axis: Months
                    title: { text: 'Months' }
                },
                yaxis: {
                    title: { text: 'Appointment Count' },
                    min: 0,
                    forceNiceScale: true
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            // Render chart
            const chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        })
        .catch(error => console.error('Error fetching chart data:', error));
</script>

</body>
</html>
