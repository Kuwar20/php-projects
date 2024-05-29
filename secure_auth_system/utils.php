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
    public static function displayFlash($name, $type){
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

    // method to send email
    public static function sendEmail($message){
        
    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.smtp2go.com/v3/email/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($message),
    CURLOPT_HTTPHEADER => [
        "Accept: */*",
        "Content-Type: application/json",
        "User-Agent: Thunder Client (https://www.thunderclient.com)"
    ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    return false;
    } else {
    return true;
    }
        }
    }

