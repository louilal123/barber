<style>
    .nav-link {
        font-size: 18px;
        padding-left: 15px; 
        padding-right: 15px;
        text-decoration: none;
    }
   
      footer {
            background-color: #212529; 
            color: #fff; 
            padding: 20px 0;
        }

        footer a {
            color: #ffc107; 
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
        .logo {
        width: 50px;
        height: 50px;
        border-radius: 50%; 
        object-fit: cover; 
    }
    .navbar-toggler {
    border: none !important; 
    box-shadow: none !important; 
    outline: none !important;
}
.brand-name{
    padding: 5px;
    /* font-family:serif, "poppins"; */
    font-weight: bold;
    /* color:rgb(110, 87, 198); */
}

</style>

<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="admin/uploads/logo.jpg" alt="Cool Cuts Logo" class="logo">
        <h2 class="brand-name"> COOL CUTS</h2>
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
                    <a class="nav-link text-light <?php echo ($current_page == 'book_appointment.php') ? 'active' : ''; ?>" href="book_appointment.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light <?php echo ($current_page == 'services.php') ? 'active' : ''; ?>" href="services.php">Services</a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link text-light <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



