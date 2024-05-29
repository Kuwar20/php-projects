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
    }
?>