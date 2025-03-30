    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div>
                <h3 class="footer-logo">BarberShop</h3>
                <p class="footer-description">Premium barber services for the modern gentleman. Experience the perfect blend of traditional techniques and contemporary styles.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            
            <div>
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="#">Home</a></li>
                    <li class="footer-link"><a href="#">Services</a></li>
                    <li class="footer-link"><a href="#">About Us</a></li>
                    <li class="footer-link"><a href="#">Gallery</a></li>
                    <li class="footer-link"><a href="#">Contact</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="footer-title">Services</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="#">Haircut</a></li>
                    <li class="footer-link"><a href="#">Beard Trim</a></li>
                    <li class="footer-link"><a href="#">Hot Towel Shave</a></li>
                    <li class="footer-link"><a href="#">Hair Styling</a></li>
                    <li class="footer-link"><a href="#">Kids Haircut</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="footer-title">Contact Us</h3>
                <div class="footer-contact">
                    <div class="footer-contact-item">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <p>123 Main Street, Melbourne, Victoria, Australia</p>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-phone contact-icon"></i>
                        <p>+61 3 1234 5678</p>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-envelope contact-icon"></i>
                        <p>info@barbershop.com</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="copyright">© 2025 BarberShop. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php if (isset($_SESSION['status']) && $_SESSION['status'] != '') { ?>
  <script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
    });

    Toast.fire({
      icon: "<?php echo $_SESSION['status_icon']; ?>",
        title: "<?php echo $_SESSION['status']; ?>"
    });
</script>
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_icon']);
    }
    ?> 

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
           
        });
    });

    
</script>

<script>
  // Validation: Allow only alphabets and spaces
  function validateName(input) {
    input.value = input.value.replace(/[^A-Za-z\s]/g, ''); // Keep only alphabets and spaces
  }

  // Validation: Allow only numeric values
  function validateNumeric(input) {
    input.value = input.value.replace(/[^0-9]/g, ''); // Keep only numbers
  }

  // Validation: Allow alphanumeric values with spaces
  function validateAlphanumeric(input) {
    input.value = input.value.replace(/[^A-Za-z0-9\s]/g, ''); // Keep alphabets, numbers, and spaces
  }

  // Validation: Allow only special characters (example for specific cases)
  function validateSpecialCharacters(input) {
    input.value = input.value.replace(/[A-Za-z0-9]/g, ''); // Remove alphabets and numbers
  }

  // Validation: Disable future dates
  function disableFutureDates(input) {
    const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
    if (input.value > today) {
      input.value = today; // Reset to today's date if a future date is selected
      alert('Future dates are not allowed.');
    }
  }
</script>
