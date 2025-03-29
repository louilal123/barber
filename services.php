<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Book an Appointment</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="node_modules\bootstrap\dist\css\bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<link rel="stylesheet" href="assets/style.css">
</head>
<style>
    .navbar {
    background-color: rgba(0, 0, 0, 0.8);
    padding: 10px 50px;
}
</style>
<body>
    <!-- Custom Cursor -->
    <div class="cursor"></div>
    
<?php include "includes/topnav.php" ?>
    

   <!-- Services Section -->
<section class="services">
    <div class="section-header">
        <h2 class="section-title">Our Premium Services</h2>
        <p class="section-subtitle">We offer a wide range of premium services to keep you looking your best. Each service is delivered with precision and care by our expert barbers.</p>
    </div>
    
    <div class="service-filters">
        <button class="filter-btn active">All Services</button>
        <button class="filter-btn">Haircuts</button>
        <button class="filter-btn">Beard Care</button>
        <button class="filter-btn">Special Treatments</button>
    </div>
    
    <?php
include 'admin/functions/connection.php'; // Database connection

// Fetch services from the database
$sql = "SELECT `id`, `name`, `description`, `service_img`, `cost` FROM `service_list` WHERE `status` = 1";
$result = $conn->query($sql);
?>

<div class="services-grid">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Sanitize output
            $serviceName = htmlspecialchars($row['name']);
            $serviceDesc = htmlspecialchars($row['description']);
            $serviceImg = htmlspecialchars($row['service_img']);
            $serviceCost = htmlspecialchars($row['cost']);
            $serviceID = htmlspecialchars($row['id']);
            
            // Display each service card
            echo '
            <div class="service-card">
                <div class="service-image">
                    <img src="admin/uploads/' . $serviceImg . '" alt="' . $serviceName . '">
                </div>
                <div class="service-content">
                   
                    <h3 class="service-title">' . $serviceName . '</h3>
                    <p class="service-description">' . $serviceDesc . '</p>
                    <span class="service-price">₱ ' . $serviceCost . '</span>
                    <div class="service-action">
                        <a href="book_appointment.php?service_id=' . $serviceID . '" class="service-btn">
                            Learn More<i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "<p>No services available at the moment.</p>";
    }

    $conn->close();
    ?>
</div>


    <!-- Add this JavaScript to the bottom of your page before the closing body tag -->
    <script>
        // Services animations
        document.addEventListener('DOMContentLoaded', () => {
            // Service cards staggered animation
            gsap.utils.toArray('.service-card').forEach((card, i) => {
                gsap.to(card, {
                    scrollTrigger: {
                        trigger: card,
                        start: 'top 85%'
                    },
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    delay: 0.1 * i
                });
            });
            
            // Filter buttons
            const filterBtns = document.querySelectorAll('.filter-btn');
            
            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    
                    // Add active class to clicked button
                    btn.classList.add('active');
                    
                    // Here you would normally filter the services
                    // For demo purposes, we just animate them
                    gsap.fromTo('.service-card', 
                        {opacity: 0, y: 20}, 
                        {opacity: 1, y: 0, stagger: 0.05, duration: 0.5}
                    );
                });
            });
        });
    </script>
</section>
 
    

    <?php include "includes/footer.php" ?>
    <script src="assets/script.js"></script>
</body>
</html>