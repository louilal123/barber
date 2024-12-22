    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
 
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

   

 
    <script>
        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('d-none');
        });
    </script>


<script src="../assets/js/main.js"></script>



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