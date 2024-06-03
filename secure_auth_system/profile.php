<?php
    session_start();
    require_once 'utils.php';

    if(!Utils::isLoggedIn()){
        Utils::redirect('projects/secure_auth_system/index.php');
    }

    $user = null;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class='bg-dark bg-gradient'>
    <div class="container">
      <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-header text-center">
              <h1 class='fw-bold text-secondary'>User Profile</h1>
            </div>
            <div class="card-body p-5">
                <?php
                    echo Utils::displayFlash('profile_update_success','success');
                    echo Utils::displayFlash('profile_update_error','danger');
                ?>
                <table class='table table-striped table-bordered'>
                    <tr>
                        <th>Name</th>
                        <td><?= $user['name'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $user['email'] ?></td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td><?= $user['created_at'] ?></td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td><?= $user['updated_at'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer px-5 text-end">
                <a href="edit_profile.php" class="btn btn-secondary">Edit Profile</a>
                <a href="search_user.php" class="btn btn-info">Search Users</a>
                <a href="action.php?logout=1" class="btn btn-primary">Logout</a>
                <a href="action.php?delete_user=1" class="btn btn-danger">Delete User</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>