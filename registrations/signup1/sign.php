<?php

  $user=0;
  $success=0;

  if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `registration` WHERE username='$username' AND password='$password'";
    
    $result = mysqli_query($con, $sql);
    
    if($result){
      $num = mysqli_num_rows($result);
      if($num > 0){
        //echo "User already exists<br>";
        $user=1;
      }else{
        $sql = "INSERT INTO `registration` (`username`, `password`) VALUES ('$username', '$password')";
        $result = mysqli_query($con, $sql);
        if($result){
          // echo "The record has been inserted successfully!<br>";
          $success=1;
        }else{
          die(mysqli_error($con));
        }
      }
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
        
  <body>
  <?php
    if($user){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> User already exists.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
      </div>';}
  ?>
    <?php
      if($success){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success</strong> You are successfuly signed up.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
      </div>';}
  ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <h1 class="text-center">Sign up Page</h1>
    <div class="container mt-5">
    <form action="sign.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter your Name">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" placeholder="Enter your password" name="password">
  </div>
  <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>
    </div>
</body>

</html>