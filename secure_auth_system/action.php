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
    // handle reset password
    public function resetPassword($token, $password, $confirm_password){
        $token = Utils::sanitize($token);
        $password = Utils::sanitize($password);
        $confirm_password = Utils::sanitize($confirm_password);

        if($password != $confirm_password){
            Utils::setFlash('reset_error', 'Password do not match');
            Utils::redirect('projects/secure_auth_system/reset.php?token='.$token);
        }else{
            $user = $this->db->getUserByToken($token);
            if($user){
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $this->db->updatePassword($user['email'], $hashed_password);
                Utils::setFlash('reset_success', 'Password reset successful');
                Utils::redirect('projects/secure_auth_system/index.php');
        }else{
            Utils::setFlash('reset_error', 'Invalid token');
            Utils::redirect('projects/secure_auth_system/reset.php?token='.$token);
        }
    }
    }

    public function updateUserProfile($name, $email) {
        $name = Utils::sanitize($name);
        $email = Utils::sanitize($email);

        $currentUser = $_SESSION['user'];
        $currentEmail = $currentUser['email'];

        // Check if the email is changing and if the new email already exists
        if ($email !== $currentEmail && $this->db->emailExists($email)) {
            Utils::setFlash('profile_update_error', 'Email already exists');
            Utils::redirect('projects/secure_auth_system/profile.php');
        } else {
            // Update the user's name and email in the database
            $this->db->updateUserProfile($currentEmail, $name, $email);

            // Update the session user data
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;

            Utils::setFlash('profile_update_success', 'Profile updated successfully');
            Utils::redirect('projects/secure_auth_system/profile.php');
        }
    }

    public function deleteUser($email) {
        $email = Utils::sanitize($email);

        $this->db->deleteUser($email);

        unset($_SESSION['user']);
        Utils::setFlash('delete_user_success', 'User deleted successfully');
        Utils::redirect('projects/secure_auth_system/index.php');
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
    } elseif(isset($_POST['reset'])){
        $authSystem->resetPassword($_POST['token'], $_POST['password'], $_POST['confirm_password']);
    } elseif (isset($_POST['update_profile'])) {
        $authSystem->updateUserProfile($_POST['name'], $_POST['email']);
    } elseif (isset($_POST['update_profile'])) {
    $authSystem->updateUserProfile($_POST['name'], $_POST['email']);
    }elseif (isset($_GET['delete_user'])) {
    $authSystem->deleteUser($_SESSION['user']['email']);
}
?>