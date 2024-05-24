<?php

$con = mysqli_connect("localhost","root","","testing","3307");

if(mysqli_connect_error()){
    echo" <script>alert('cannot connect to the db)</script>";
    exit();
}


/* 
// one way to check connection
if($con){
    echo "Connection Successful.";
}
else{
    die(mysqli_error($con));    
} 
*/
?>