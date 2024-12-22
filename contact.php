<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - BBAS</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .nav-link {
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

        .contact-info {
            font-size: 1.1rem;
        }


        .contact-info h4 {
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-secondary">
    <!-- Navigation Bar -->
    <?php include "includes/topnav.php" ?>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="py-3">
            <br><br><br>
            <div class="card">
                <div class="card-header bg-dark ">
                <h2 class="text-center text-light">Contact Us</h2>
                </div>
                    <div class="card-body">
                
                        <div class="contact-info">
                            <div class="mb-3">
                                <h4>Email:</h4>
                                <p>info@barbers.com</p>
                            </div>
                            <div class="mb-3">
                                <h4>Contact #:</h4>
                                <p>09123456789 / 456-4568-7899</p>
                            </div>
                            <div class="mb-3">
                                <h4>Location:</h4>
                                <p>Poblacion Madridejos Cebu</p>
                            </div>
                            <div class="mb-3">
                                <h4>Open Time:</h4>
                                <p>09:00 AM - 07:00 PM</p>
                            </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br>
        </div>
    </div>
<?php include "includes/footer.php";?>
</body>
</html>
