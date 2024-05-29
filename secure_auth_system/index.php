<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class='bg-dark bg-gradient'>
    <div class="container">
      <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-header text-center">
              <h1 class='fw-bold text-secondary'>Login</h1>
            </div>
            <div class="card-body p-5">
              <form action="action.php" method="POST">
                <input type="hidden" name="login" value="1">
                
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <a href="forgot.php">Forgot Password?</a>
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" value="Login" class="btn btn-primary">Login</button>
                </div>
                <p class="text-center">Don't have an account? <a href="register.php">Register</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>