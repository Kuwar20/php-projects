<?php
    require_once 'database.php';
    require_once 'utils.php';

    $db = new Database;
    $util = new Util;

    // Handle Add new user ajax request

    // formData.append("add", 1);
    if(isset($_POST['add'])){
        $fname =$util->sanitize($_POST['fname']);
        $lname =$util->sanitize($_POST['lname']);
        $email =$util->sanitize($_POST['email']);
        $phone =$util->sanitize($_POST['phone']);

        if($db->insert($fname,$lname,$email,$phone)){
            echo $util->showMessage('success','User Added Successfully');
        }else{
            echo $util->showMessage('danger','Failed to Add User');
        }
    }

?>