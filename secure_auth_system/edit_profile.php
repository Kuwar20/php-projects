<?php
session_start();
require_once 'utils.php';
require_once 'database.php';

if (!isset($_SESSION['user'])) {
    Utils::redirect('projects/secure_auth_system/index.php');
}

$user = $_SESSION['user'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class='bg-dark bg-gradient'>
<div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h1 class='fw-bold text-secondary'>Edit Profile</h1>
                </div>
                <div class="card-body p-5">
                    <form action="action.php" method="POST">
                        <input type="hidden" name="update_profile" value="1">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $user['name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
