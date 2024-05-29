<?php

require_once 'config.php';

class Utils {

    // Method to sanitize input value
    public static function sanitize($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // Method to redirect to a given page
    public static function redirect($page){
        header('location:' . BASE_URL . '/' . $page);
    }

    // Method to set a flash message
    public static function setFlash($name,$message){
        if(!empty($_SESSION[$name])){
            unset($_SESSION[$name]);
        }
        $_SESSION[$name] = $message;
    }
    // Message to display flash message
    public static function displayFlash($name){
        if(isset($_SESSION[$name])){
            echo '<div class="alert alert-'. $type .'">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
        }
    }
    // Method to check if user is logged in
    public static function isLoggedIn(){
        if(isset($_SESSION['user'])){
            return true;
        }else{
            return false;
        }
    }
}

?>