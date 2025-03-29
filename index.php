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
<body>
    <!-- Custom Cursor -->
    <div class="cursor"></div>
    
    <!-- Navigation -->
 <!-- Navigation -->


<?php include "includes/topnav.php" ?>
    
    <!-- Hero Section -->
    <section class="hero">
        <img src="admin/uploads/bg.jpg" alt="Barbershop" class="hero-image">
        <div class="hero-text">
            <p class="hero-subtitle">PREMIUM BARBER SERVICES</p>
            <h1 class="hero-title">Where Style Meets Convenience</h1>
            <p class="hero-description">Experience the art of grooming with our expert barbers. We're dedicated to delivering precision cuts and exceptional service in a stylish, relaxing environment.</p>
            <a href="book_appointment" class="btn-book">Book Your Cut</a>
        </div>
        
        <div class="scroll-indicator">
            <span class="scroll-text">Scroll Down</span>
            <div class="scroll-line"></div>
        </div>
    </section>
    
    <!-- Services Section -->
    <section class="services">
        <div class="section-header">
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">We offer a wide range of premium services to keep you looking your best. Each service is delivered with precision and care.</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-cut"></i>
                </div>
                <h3 class="service-title">Haircut</h3>
                <p class="service-description">Our precision haircuts are tailored to your face shape, hair type, and personal style for a look that's uniquely you.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-beard"></i>
                </div>
                <h3 class="service-title">Beard Trim</h3>
                <p class="service-description">Keep your facial hair looking sharp with our expert beard trimming and shaping services.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-hot-tub"></i>
                </div>
                <h3 class="service-title">Hot Towel Shave</h3>
                <p class="service-description">Experience the ultimate in relaxation with our traditional hot towel shave, leaving your skin smooth and refreshed.</p>
            </div>
        </div>
    </section>
    
    <!-- Location Section -->
    <section class="location">
        <div class="location-content">
            <div class="location-text">
                <h2 class="location-title">Find Us</h2>
                <p class="location-description">Located in the heart of the city, our barbershop is easily accessible and ready to serve you with the highest quality grooming services.</p>
                
                <div class="location-details">
                    <div class="location-item">
                        <div class="location-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <p class="location-info">123 Main Street, Melbourne, Victoria, Australia</p>
                    </div>
                    
                    <div class="location-item">
                        <div class="location-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <p class="location-info">+61 3 1234 5678</p>
                    </div>
                    
                    <div class="location-item">
                        <div class="location-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <p class="location-info">Mon-Sat: 9AM - 8PM | Sun: 10AM - 6PM</p>
                    </div>
                </div>
                
                <a href="#" class="btn-book">Get Directions</a>
            </div>
            
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509607!2d144.95373631531666!3d-37.81627917975159!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d5df1a8d5e1%3A0x5045675218cee20!2sMelbourne%2C+Victoria%2C+Australia!5e0!3m2!1sen!2sph!4v1644255678901!5m2!1sen!2sph"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="section-header">
            <h2 class="section-title">What Our Clients Say</h2>
            <p class="section-subtitle">Don't just take our word for it. Here's what our satisfied customers have to say about their experience.</p>
        </div>
        
        <div class="testimonial-slider">
            <div class="testimonial">
                <p class="testimonial-text">"The best haircut I've ever had. The attention to detail and the friendly atmosphere make this place my go-to barbershop in the city."</p>
                <div class="testimonial-author">
                    <img src="/api/placeholder/60/60" alt="John Doe" class="author-avatar">
                    <div>
                        <h4 class="author-name">John Doe</h4>
                        <p class="author-title">Loyal Customer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <?php include "includes/footer.php" ?>
    <script src="assets/script.js"></script>
</body>
</html>