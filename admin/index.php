<?php 
session_start();
$lock_duration = 30; // Lock time in seconds
$max_attempts = 3; // Max incorrect attempts before lock

// Check lock status and calculate remaining time
if (isset($_SESSION['lock_time'])) {
    $elapsed_time = time() - $_SESSION['lock_time']; 
    $time_left = max(0, $lock_duration - $elapsed_time);

    if ($time_left <= 0) {
        unset($_SESSION['lock_time']);
        $_SESSION['login_attempts'] = 0;
    }
} else {
    $time_left = 0; // No lock
}

// Remaining attempts
$attempts_left = $max_attempts - ($_SESSION['login_attempts'] ?? 0);
$is_locked = isset($_SESSION['lock_time']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>BARBER</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { text-decoration: none; }
    .card, .btn { border-radius: 0px; }
    .disabled-form { pointer-events: none; opacity: 0.5; }
    input:disabled { background-color: #ddd !important; cursor: not-allowed; }
    .progress-container { width: 100%; background: #ccc; height: 10px; border-radius: 5px; margin-top: 10px; }
    .progress-bar { height: 10px; background-color: red; transition: width 1s linear; }
  </style>
</head>
<body>
  <main class="main bg-black">
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="d-flex justify-content-center mb-4">
              <h1 class="text-black fw-bold" style="text-shadow: 2px 2px 4px yellow;"> COOL cuts Management System </h1>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
          <div class="pt-4 pb-2">
            <h2 class="text-black fw-bold text-center pb-0 fs-4 mb-2" style="text-shadow: 2px 2px 4px yellow;"> Welcome Back Administrator </h2>
          </div>

          <div class="card mb-3">
            <div class="card-body <?php echo $is_locked ? 'disabled-form' : ''; ?>">
              <form class="row g-3 needs-validation" action="functions/login.php" method="POST" novalidate>
                <div class="col-12">
                  <label for="yourUsername" class="form-label">Email or Username</label>
                  <div class="input-group has-validation">
                    <input type="text" name="username" class="form-control" id="yourUsername" required <?php echo $is_locked ? 'disabled' : ''; ?>>
                    <div class="invalid-feedback">Please enter your username.</div>
                  </div>
                </div>
                <div class="col-12">
                  <label for="yourPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="yourPassword" required <?php echo $is_locked ? 'disabled' : ''; ?>>
                  <div class="invalid-feedback">Please enter your password!</div>
                </div>
                <div class="col-12">
                  <button class="btn btn-success w-100" type="submit" id="loginBtn" disabled <?php echo $is_locked ? 'disabled' : ''; ?>>SIGNIN</button>
                </div>
              </form>
            </div>
          </div>

          <?php if ($is_locked): ?>
          <div class="progress-container">
            <div id="progress-bar" class="progress-bar" style="width: <?php echo ($time_left / $lock_duration) * 100; ?>%;"></div>
          </div>
          <?php endif; ?>
        </div>
      </section>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let usernameInput = document.getElementById("yourUsername");
      let passwordInput = document.getElementById("yourPassword");
      let loginBtn = document.getElementById("loginBtn");

      function checkInputs() {
        loginBtn.disabled = !(usernameInput.value.trim() && passwordInput.value.trim());
      }

      usernameInput.addEventListener("input", checkInputs);
      passwordInput.addEventListener("input", checkInputs);
    });
  </script>

  <?php if ($is_locked): ?>
    <script>
      let timeLeft = <?php echo $time_left; ?>;
      let totalDuration = <?php echo $lock_duration; ?>;

      Swal.fire({
        icon: "error",
        title: "Too many failed attempts!",
        html: `
          Try again in <b><span id='countdown'>${timeLeft}</span></b> seconds.
        `,
        allowOutsideClick: false,
        showConfirmButton: false
      });

      let countdownElem = document.getElementById("countdown");
      let progressBar = document.getElementById("progress-bar");

      let countdownInterval = setInterval(() => {
        if (timeLeft > 0) {
          timeLeft--;
          countdownElem.textContent = timeLeft;
          progressBar.style.width = (timeLeft / totalDuration) * 100 + "%";
        } else {
          clearInterval(countdownInterval);
          location.reload();
        }
      }, 1000);
    </script>
  <?php endif; ?>

  <?php
  if (isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
    <script>
      Swal.fire({
        icon: "<?php echo $_SESSION['status_icon']; ?>",
        title: "<?php echo $_SESSION['status']; ?>",
        text: "<?php echo !$is_locked ? 'Attempts left: ' . $attempts_left : 'Try again in ' . $time_left . ' seconds.'; ?>",
        confirmButtonText: "Ok"
      });
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['status_icon']);
  endif;
  ?>
</body>
</html>