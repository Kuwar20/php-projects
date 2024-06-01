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
    // Handle fetch all users ajax request
    if(isset($_GET['fetch'])){
        $users = $db->read();
        $output = '';
        if($users){
            foreach($users as $row){
                $output .= '
                    <tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['first_name'].'</td>
                        <td>'.$row['last_name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit" data-id="'.$row['id'].'">Edit</button>
                            <button class="btn btn-sm btn-danger delete" data-id="'.$row['id'].'">Delete</button>
                        </td>
                    </tr>
                ';
            }
            echo $output;
        }else{
            echo '<tr><td colspan="6">No Users Found</td></tr>';
        }
    }
?>