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
            font-size: 24px;
        }

        /* Increase font size of input fields */
        .form-control {
            font-size: 16px;
        }

        /* Increase font size of table header and data */
        .table th, .table td {
            font-size: 18px;
        }

      

        /* Center title and add spacing */
        .home-title {
            font-size: 52px;
            font-weight: bold;
            text-align: center;
            margin-top: 50px;
            color: #fff;
        }

       
        /* Center the button */
        .btn-book {
            display: block;
            width: 250px;
            margin: 20px auto;
            font-size: 18px;
            padding: 15px 0px ;
        }
       
    </style>
</head>
<body class="bg-secondary">
    <!-- Navigation Bar -->
    <?php include "includes/topnav.php"?>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="py-3">
                <div class="card-body text-center">
                    <!-- System Title --><br><br><br><br><br><br>
                    <h1 class="home-title">WELCOME TO BARBERSHOP BOOKING APPOINTMENT SYSTEM</h1>

                    <!-- Button to Book Appointment --> <br>
                    <a href="book_appointment.php" class="btn btn-primary btn-book">BOOK NOW</a><br><br><br>
                    <br><br><br><br><br><br>
            
            </div>
        </div>
    </div>

    <?php include "includes/footer.php";?>
</body>
</html>
