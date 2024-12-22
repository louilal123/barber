<style>
    .nav-link {
        font-size: 20px;
        padding-left: 15px;  /* Add space to the left of the nav link */
        padding-right: 15px; /* Add space to the right of the nav link */
        text-decoration: none; /* Remove default underline */
    }

    body{
            overflow: hidden;
        }

    .btn {
        
        border-radius: 0px !important;
    }
      /* Style for footer */
      footer {
            background-color: #212529; /* Dark footer */
            color: #fff; /* White text */
            padding: 20px 0;
        }

        footer a {
            color: #ffc107; /* Highlight links in footer */
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
</style>

<?php
    // Get the current page URL or path
    $current_page = basename($_SERVER['PHP_SELF']);
?>



<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <h1 class="text-light">BBAS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light <?php echo ($current_page == 'services.php') ? 'active' : ''; ?>" href="services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light <?php echo ($current_page == 'book_appointment.php') ? 'active' : ''; ?>" href="book_appointment.php">Book Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

