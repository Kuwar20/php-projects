<!-- connect to the db on myphpadmin -->

<?php
    $HOSTNAME='localhost';
    $USERNAME='root';
    $PASSWORD='';
    $DBNAME='signupforms';

    // No need to specify the port for default MySQL installation that is 3306
    // but if you have changed the port for xampp mysql installation, then you need to specify the port number
    
    $PORT = 3307; 

    // Create connection
    $con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DBNAME, $PORT);

    // Check connection
    if($con){
        echo "Connection Successful.";
    }
    else{
        die(mysqli_error($con));    
    }
?>