<?php
    require('connection.php');

    if(isset($_PORT['register'])){
        $user_exist_query = "SELECT * FROM `registered_users` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]'";
        $result= mysqli_query($con, $user_exist_query);
        
        if($result){
            if(mysqli_num_rows($result)>0){
                echo " <script>alert('User already exists')</script>";
                exit();
            }
        }else{
            echo " <script>
            alert('cannot run query');
            window.location.href = 'index.php';
            </script>";
            exit();
        }
    }
    ?>