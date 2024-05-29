<?php
  session_start();

  require_once 'utils.php';
  if(Utils::isLoggedIn()) {
    Utils::redirect('projects/secure_auth_system/profile.php');
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class='bg-dark bg-gradient'>
    <div class="container">
      <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-header text-center">
              <h1 class='fw-bold text-secondary'>Reset Password</h1>
            </div>
            <div class="card-body p-5">
              <?php
                echo Utils::displayFlash('reset_error','danger');
                echo Utils::displayFlash('reset_success','success');
              ?>
              <form action="action.php" method="POST">
                <input type="hidden" name="reset" value="1">
                <input type="hidden" name="token" value="<?= $_GET['token'] ??'' ?>">

                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <div class="mb-3 d-grid">
                    <input type="submit" value='Reset Password' class='btn btn-primary'>
                </div>
                <p class="text-center">Go back to Login Page? <a href="index.php">Login</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>