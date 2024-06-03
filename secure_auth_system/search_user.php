<?php
session_start();
require_once 'utils.php';
require_once 'database.php';

if (!Utils::isLoggedIn()) {
    Utils::redirect('projects/secure_auth_system/index.php');
}

$searchResults = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchTerm = Utils::sanitize($_POST['search']);
    $db = new Database();
    $searchResults = $db->searchUser($searchTerm);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class='bg-dark bg-gradient'>
<div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h1 class='fw-bold text-secondary'>Search Users</h1>
                </div>
                <div class="card-body p-5">
                    <form action="search_user.php" method="POST">
                        <div class="mb-3">
                            <label for="search">Search by Name or Email</label>
                            <input type="text" name="search" id="search" class="form-control" required>
                        </div>
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>

                    </form>
                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                        <?php if (count($searchResults) > 0): ?>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($searchResults as $result): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($result['name']) ?></td>
                                            <td><?= htmlspecialchars($result['email']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="alert alert-warning">No users found.</div>
                        <?php endif; ?>
                    <?php endif; ?>
                        <div class="text-center">
                            <a href="profile.php" class="btn btn-secondary mt-2 ">Back to Profile</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>