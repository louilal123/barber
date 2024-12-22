<style>
  /* Sidebar styles */
  #sidebar {
    
    min-height: 100vh;
    width: 250px;
    color: white;
    padding: 1rem 0;
  }

  #sidebar .nav-link {
    color:rgb(255, 255, 255);
    padding: 0.5rem 1rem;
    
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  #sidebar .nav-link:hover {
    background-color: #495057;
    color: #ffffff;
  }

  #sidebar .nav-link .fas {
    margin-right: 10px;
    font-size: 1.2rem;
    margin-left: 0.5rem;
  }

  #sidebar .nav-item.active .nav-link {
    background-color: #007bff;
    color: white;
  }

  #sidebar h4 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  #sidebar .nav-item {
    margin-bottom: 0.5rem;
  }
  

  /* Responsive adjustments */
  @media (max-width: 768px) {
    #sidebar {
      width: 100%;
    }
  }
</style>
<?php
$currentPage = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav id="sidebar" class="d-flex flex-column" role="navigation">
  <div class="p-4 text-center mb-2">
   <h5>BARBER BOOKING APPOINTMENT SYSTEM</h5>
  </div>
  <ul class="nav flex-column">
    <!-- Dashboard -->
    <li class="nav-item <?php echo $currentPage === 'dashboard' ? 'active' : ''; ?>">
      <a class="nav-link <?php echo $currentPage === 'dashboard' ? 'bg-dark' : ''; ?>" href="dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
      </a>
    </li>
    <!-- Rooms -->
    <li class="nav-item <?php echo $currentPage === 'appointments_list' ? 'active' : ''; ?>">
      <a class="nav-link <?php echo $currentPage === 'appointments_list' ? 'bg-dark' : ''; ?>" href="appointments_list">
        <i class="fas fa-calendar-day"></i> Appointments List
      </a>
    </li>
    <!-- Room Types -->
    <li class="nav-item <?php echo $currentPage === 'service_list' ? 'active' : ''; ?>">
      <a class="nav-link <?php echo $currentPage === 'service_list' ? 'bg-dark' : ''; ?>" href="service_list">
        <i class="fas fa-th-list"></i> Services List
      </a>
    </li>
   
   
    <!-- Reports -->
    <li class="nav-item <?php echo $currentPage === 'reports' ? 'active' : ''; ?>">
      <a class="nav-link <?php echo $currentPage === 'reports' ? 'bg-dark' : ''; ?>" href="reports">
        <i class="fas fa-chart-bar"></i> Reports
      </a>
    </li>
    <!-- System Users -->
   

    <li class="nav-item <?php echo $currentPage === 'users' ? 'active' : ''; ?>">
      <a class="nav-link <?php echo $currentPage === 'users' ? 'bg-dark' : ''; ?>" href="users">
        <i class="fas fa-user-cog"></i> System Users
      </a>
    </li>

  </ul>
</nav>
