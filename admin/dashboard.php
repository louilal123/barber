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
    <div id="content" class="flex-grow-1">
        <!-- Top Navigation -->
        <?php include "includes/topnav.php" ?>

        <!-- Dashboard -->
        <div class="container-fluid mt-4">
            <h1 class="mb-4" style="font-family: 'Arial', sans-serif; font-weight: bold; color: #333;">
                Welcome <?php echo htmlspecialchars($admin_username) ?>
            </h1>

            <!-- Info Boxes -->
            <div class="row">
                <!-- Total Income -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card card1 bg-primary text-white h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="ps-3">
                                <h6 class="card-title">Total Income</h6>
                                <h1>₱ <?php echo number_format($totalIncome, 2); ?></h1>
                            </div>
                            <div class="card-icon ms-auto">
                                <i class="icon fas fa-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card card1 bg-warning text-white h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="ps-3">
                                <h6 class="card-title">Services</h6>
                                <h1><?php echo $serviceCount; ?></h1>
                            </div>
                            <div class="card-icon ms-auto">
                                <i class="icon fas fa-concierge-bell"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointments -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card card1 bg-success text-white h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="ps-3">
                                <h6 class="card-title">Appointments</h6>
                                <h1><?php echo $appointmentCount; ?></h1>
                            </div>
                            <div class="card-icon ms-auto">
                                <i class="icon fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card card1 bg-danger text-white h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="ps-3">
                                <h6 class="card-title">Users</h6>
                                <h1><?php echo $userCount; ?></h1>
                            </div>
                            <div class="card-icon ms-auto">
                                <i class="icon fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row mt-4">
                <!-- Monthly Income Chart -->
                <div class="col-md-6 mt-2">
                <div class="card">
                        <div class="card-body">
                            <h5>Verified vs Unverified Appointments (Last 30 Days)</h5>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-2 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5>Most Selected Services</h5>
                            <div id="service-chart"></div>
                        </div>
                    </div>
                </div>


                
                <div class="col-md-12 mt-2">
                <div class="card">
                        <div class="card-body">
                            <h5>Monthly Income</h5>
                            <div id="line-chart"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

  <?php include "includes/footer.php"; ?>
  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  // Fetch data from the backend
  fetch('functions/fetch_appointment_stats.php')
    .then(response => response.json())
    .then(data => {
      const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'
      ];

      // Convert your data into arrays
      const categories = data.map(item => monthNames[item.month - 1]); 
      const verifiedSeries = data.map(item => item.verified);
      const unverifiedSeries = data.map(item => item.unverified);

      // Find the largest number among verified & unverified
      const maxValue = Math.max(...verifiedSeries, ...unverifiedSeries);

      // Dynamically set a comfortable y-axis max
      const dynamicMax = maxValue < 5 ? 5 : maxValue + 2;

      // ApexCharts configuration
      const options = {
        chart: {
          type: 'bar',
          height: 400,
          width: '100%'
        },
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
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: categories,
          title: {
            text: "Months",
            style: {
              fontSize: '14px',
              fontWeight: 'bold'
            }
          }
        },
        yaxis: {
          min: 0,
          max: dynamicMax,
          tickAmount: 5,
          title: {
            text: "Number of Appointments",
            style: {
              fontSize: '14px',
              fontWeight: 'bold'
            }
          }
        },
        colors: ['#008FFB', '#FF4560'],
        legend: {
          show: false  // <--- Hides the legend
        },
        title: {
          text: "Verified vs Unverified Appointments (2025)",
          align: "center",
          style: {
            fontSize: '16px',
            fontWeight: 'bold'
          }
        }
      };

      // Render the chart
      const chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
    })
    .catch(error => console.error('Error fetching chart data:', error));
</script><script>
  // Fetch data from the backend
  fetch('functions/fetch_monthly_income.php')
    .then(response => response.json())
    .then(data => {
      const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
      ];

      // Extract data with 0 as default if missing
      const categories = monthNames;
      const incomeSeries = monthNames.map((_, index) => data[index]?.total_income || 0);

      // ApexCharts configuration
      const options = {
        chart: {
          type: 'line',
          height: 400,
          width: '100%'
        },
        series: [
          {
            name: "Monthly Total Income",
            data: incomeSeries
          }
        ],
        stroke: {
          curve: 'smooth',
          width: 3
        },
        xaxis: {
          categories: categories,
          title: {
            text: "Months",
            style: {
              fontSize: '14px',
              fontWeight: 'bold'
            }
          }
        },
        yaxis: {
          min: 0,
          title: {
            text: "Total Income (₱)",
            style: {
              fontSize: '14px',
              fontWeight: 'bold'
            }
          }
        },
        colors: ['#4CAF50'],
        title: {
          text: "Monthly Income Overview",
          align: "center",
          style: {
            fontSize: '16px',
            fontWeight: 'bold'
          }
        }
      };

      // Render the chart
      const chart = new ApexCharts(document.querySelector("#line-chart"), options);
      chart.render();
    })
    .catch(error => console.error('Error fetching chart data:', error));
</script>

<script>
  // Fetch data from the backend
  fetch('functions/fetch_most_selected_service.php')
    .then(response => response.json())
    .then(data => {
      const serviceNames = data.map(item => item.service_name);
      const bookingCounts = data.map(item => item.booking_count);

      // ApexCharts configuration for Pie Chart
      const options = {
        chart: {
          type: 'pie',
           height: 410,
          width: '100%'
        },
        labels: serviceNames,
        series: bookingCounts,
        colors: ['#4CAF50', '#FFC107', '#FF5722', '#03A9F4', '#9C27B0'],
        legend: {
          position: 'bottom'
        },
        title: {
          text: "Most Selected Services",
          align: "center",
          style: {
            fontSize: '16px',
            fontWeight: 'bold'
          }
        }
      };

      // Render the chart
      const chart = new ApexCharts(document.querySelector("#service-chart"), options);
      chart.render();
    })
    .catch(error => console.error('Error fetching service data:', error));
</script>


</body>
</html>
