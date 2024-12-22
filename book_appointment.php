<?php
session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Book an Appointment</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
          .nav-link{
            font-size: 18px;
        }
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
        <style>
        /* Increase font size of navigation links */
        .nav-link {
            font-size: 20px;
        }

        /* Increase font size of card title */
        .card-title {
            font-size: 24px;
        }

        /* Increase font size of form labels */
        .form-label {
            font-size: 18px;
        }

        /* Increase font size of input fields */
        .form-control {
            font-size: 16px;
        }

        /* Increase font size of table header and data */
        .table th, .table td {
            font-size: 18px;
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
      
    </style>
</head>
<body class="bg-secondary">
    <!-- Navigation Bar -->
<?php include "includes/topnav.php"?>

    <!-- Main Content --><br><br>
    <div class="container my-5">
        <div class="py-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark">
                    <h5 class="card-title mb-0 text-light">Book an Appointment</h5>
                    <button class="btn btn-success btn-lg" type="button" onclick="location.replace(document.referrer)">
                        <i class="fa fa-angle-left"></i> Back
                    </button>
                </div>
                <div class="card-body">

                
                <form action="admin/functions/process_appointment.php" method="POST" id="appointment-form">
                    <div class="row">
                        <!-- Fullname -->
                        <div class="col-md-6 mb-3">
                            <label for="fullname" class="form-label">Fullname</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required>
                            <div class="invalid-feedback">Please enter a valid name (letters and spaces only).</div>
                        </div>
                        <!-- Contact -->
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label">Contact #</label>
                            <input type="text" name="contact" id="contact" class="form-control" required>
                            <div class="invalid-feedback">Please enter a valid 11-digit contact number.</div>
                        </div>
                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <!-- Schedule Date -->
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Schedule Date</label>
                            <input type="date" name="schedule" id="date" class="form-control" required>
                            <div class="invalid-feedback">Please select a valid date (today or later).</div>
                        </div>
                    </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Service</th>
                                        <th>Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Database connection
                                        include 'admin/functions/connection.php';
                                        $services_query = $conn->query("SELECT id, name, description, cost FROM service_list WHERE 1");

                                        while ($row = $services_query->fetch_assoc()):
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="service_id[]" value="<?= $row['id'] ?>" class="form-check-input">
                                            </td>
                                            <td><?= $row['name'] ?></td>
                                            <td class="text-center"><?= number_format($row['cost'], 2) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="submit" name="book_appointment">Book Now</button>
                        </div>
                </form>


                
                        </div>
                       
                </div>
            </div>
        </div>
    </div>
<br><br><br>

<?php include "includes/footer.php";?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById('date');

        // Get today's date in the format YYYY-MM-DD
        const today = new Date();
        const formattedToday = today.toISOString().split('T')[0];

        // Set the minimum date to today's date
        dateInput.setAttribute('min', formattedToday);
    });
</script>
    <script>
document.getElementById('appointment-form').addEventListener('submit', function(event) {
    const selectedServices = document.querySelectorAll('input[name="service_id[]"]:checked');
    if (selectedServices.length === 0) {
        alert('Please select at least one service.');
        event.preventDefault();  // Prevent form submission
    }
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fullnameInput = document.getElementById('fullname');
        const contactInput = document.getElementById('contact');
        const dateInput = document.getElementById('date');

        // Restrict Fullname Input to Letters and Spaces Only
        fullnameInput.addEventListener('keypress', function (e) {
            const char = String.fromCharCode(e.which);
            if (!/^[a-zA-Z\s]$/.test(char)) {
                e.preventDefault(); // Block invalid input
            }
        });

        fullnameInput.addEventListener('input', function () {
            // Remove invalid characters pasted into the field
            fullnameInput.value = fullnameInput.value.replace(/[^a-zA-Z\s]/g, '');
        });

        // Restrict Contact Input to Numbers Only and Limit to 11 Digits
        contactInput.addEventListener('keypress', function (e) {
            const char = String.fromCharCode(e.which);
            if (!/^\d$/.test(char) || contactInput.value.length >= 11) {
                e.preventDefault(); // Block invalid input
            }
        });

        contactInput.addEventListener('input', function () {
            // Remove invalid characters pasted into the field and enforce 11-digit limit
            contactInput.value = contactInput.value.replace(/[^\d]/g, '').slice(0, 11);
        });

        // Schedule Date Validation
        dateInput.addEventListener('change', function () {
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Normalize to start of the day
            const selectedDate = new Date(dateInput.value);

            if (selectedDate < today) {
                dateInput.classList.add('is-invalid');
            } else {
                dateInput.classList.remove('is-invalid');
            }
        });

        // Form Submission Validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            const inputs = form.querySelectorAll('input');
            let isValid = true;

            inputs.forEach(input => {
                if (input.classList.contains('is-invalid') || !input.checkValidity()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if invalid
                alert("Please correct the errors in the form before submitting.");
            }
        });
    });
</script>

<?php include "includes/footer.php";?>


</body>
</html>
