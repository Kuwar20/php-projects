<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <!-- Add New User Start -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addNewUserModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Add New User</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="add-user-form" class="p-2" novalidate>
            <div class="mb-3">
                <div class="row mb-3 gx-3">
                    <div class="col">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" required>
                    <div class="invalid-feedback">First name is required!</div>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" required>
                    <div class="invalid-feedback">Last name is required!</div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    <div class="invalid-feedback">Email is required!</div>
                </div>
                <div class="mb-3">
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required>
                    <div class="invalid-feedback">Phone is required!</div>
                </div>
</div>
<div class="mb-3">
    <input type="submit" class="btn btn-primary btn-block btn-lg w-100" value='Add User' id="add-user-btn">
</div>
        </form>        
</div>
    </div>
</div>
</div>
    <!-- Add New User end -->

    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                <h4 class="text-primary">All Users In DB</h4>
                </div>
            <div>
                    <button 
                    class="btn btn-primary" 
                    type="button"
					data-bs-toggle="modal" 
					data-bs-target="#addNewUserModel">Add New User</button> 
        </div>
        </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kuwar</td>
                                <td>Singh</td>
                                <td>kuwarx1@gmail.com</td>
                                <td>1234567890</td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm rounded-pill py-0">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm rounded-pill py-0">Delete</a>
                                </td>
                            </tr>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>