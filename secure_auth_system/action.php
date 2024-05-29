<?php

require_once 'utils.php';
require_once 'database.php';

    class AuthSystem{
        private $db;

        public function __construct(){
            session_start();
            $this->db = new Database();
        }

        // handle register user
        public function registerUser($name, $email, $password,$confirm_password){
            $name = Utils::sanitize($name);
            $email = Utils::sanitize($email);
            $password = Utils::sanitize($password);
            $confirm_password = Utils::sanitize($confirm_password);

            if($password != $confirm_password){
                Utils::setFlash('password_error', 'Password do not match');
                Utils::redirect('projects/secure_auth_system/register.php');
            } else{
                $user = $this->db->emailExists($email);
                if($user){
                    Utils::setFlash('error', 'Email already exists');
                    Utils::redirect('projects/secure_auth_system/register.php');
                } else{
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $this->db->register($name, $email, $hashed_password);
                    Utils::setFlash('register_success', 'You are now registered and can log in');
                    Utils::redirect('projects/secure_auth_system/index.php');
                }
            }
        }
        
        public function loginUser($email, $password){
            $email = Utils::sanitize($email);
            $password = Utils::sanitize($password);
    
            $user = $this->db->login($email, $password);
            
            if($user){
                unset($user['password']);
                $_SESSION['user'] = $user;
                Utils::redirect('projects/secure_auth_system/profile.php');
            }else{
                Utils::setFlash('login_error', 'Invalid credentials');
                Utils::redirect('projects/secure_auth_system/index.php');
            }
        }

        // handle logout
        public function logoutUser(){
            unset($_SESSION['user']);
            Utils::redirect('projects/secure_auth_system/index.php');
        }

        // handle forgot password
        public function forgotPassword($email){
            $email = Utils::sanitize($email);
            $user = $this->db->emailExists($email);

            if($user){
                $token = bin2hex(random_bytes(50));
                $this->db->setToken($email, $token);
                $link = BASE_URL. '/projects/secure_auth_system/reset.php?email='.$email.'&token='.$token;
                $message = '<p>Hello '.$user['name']. '</p> <p>Please click on the following link to reset your password: </p> <p><a href="'.$link.'">' .$link. '</a></p>';

                $mailData = [

                        "api_key" => "api-E5794DAC4ED54CEAAF1E59F9DAD39EE8",
                        "to" => [$email],
                        "sender" => "Kuwar Singh PHP Project <cakrob@uf.edu.pl>",
                        "subject" => "Reset Password - Secure Auth System",
                        "text_body" => "Reset your password",
                        "html_body" => $message
            
                ];
                if(Utils::sendMail($mailData)){
                    Utils::setFlash('forgot_success', 'Password reset link has been sent to your email');
                    Utils::redirect('projects/secure_auth_system/forgot.php');
                }
                else{
                        Utils::setFlash('forgot_error', 'Something went wrong');
                        Utils::redirect('projects/secure_auth_system/forgot.php');
                        }
                }else{
                    Utils::setFlash('forgot_error', 'Email does not exist');
                    Utils::redirect('projects/secure_auth_system/forgot.php');
                }
}
}


    $authSystem = new AuthSystem();

    if(isset($_POST['register'])){
        $authSystem->registerUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
        
        // $name = $_POST['name'];
        // $email = $_POST['email'];
        // $password = $_POST['password'];
        // $confirm_password = $_POST['confirm_password'];
        // $authSystem->registerUser($name, $email, $password, $confirm_password);
    } elseif(isset($_POST['login'])){
        $authSystem->loginUser($_POST['email'], $_POST['password']);
    } elseif(isset($_GET['logout'])){
        $authSystem->logoutUser();
    } elseif(isset($_POST['forgot'])){
        $authSystem->forgotPassword($_POST['email']);
    }
?>