<!DOCTYPE html>
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
</head>
<body class="bg-secondary">
    <!-- Navigation Bar -->
    <?php include "includes/topnav.php"?>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="py-3">
            <div class="card">
            <div class="card-header bg-dark ">
                <h2 class="text-center text-light">Services List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Database connection
                                include 'admin/functions/connection.php'; // Make sure this points to your actual database connection file
                                
                                // Fetch services from the database
                                $services_query = $conn->query("SELECT id, name, description FROM service_list WHERE 1");
                                
                                // Display each service
                                while ($row = $services_query->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<br><br><br>
    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">© 2024 BBAS. All rights reserved. Designed by <a href="#">Brian Nick Acorda</a>.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
