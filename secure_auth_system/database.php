<?php

require_once 'config.php';

class Database{
    // Port is necessary as default port is taken by MySQL, Hence we use another port
    
    private const DSN = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME;
    private $conn;

    // method to connect to the database
    public function __construct(){
        try{
            $this->conn = new PDO(self::DSN, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo("Connection failed: ".$e->getMessage());
        }
    }

    // method to register an user
    public function register($name, $email, $password){
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

    // method to check if an email exists
    public function emailExists($email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user;
    }

    // method to login an user
    public function login($email, $password){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if($user){
            if(password_verify($password, $user['password'])){
                return $user;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // method to set a token for password reset
    public function setToken($email, $token){
        $sql = "UPDATE users SET token = :token WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token' => $token, 'email' => $email]);
        return true;
    }
    
    // method to update password
    public function updatePassword($email, $password){
        $sql = "UPDATE users SET password = :password, token = :token WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['password' => $password, 'token' => null, 'email' => $email]);
        return true;
    }

    public function getUserByToken($token){
        $sql = "SELECT * FROM users WHERE token = :token";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token' => $token]);
        $user = $stmt->fetch();
        return $user;
    }

    public function updateUserProfile($currentEmail, $name, $newEmail) {
        $sql = "UPDATE users SET name = :name, email = :email WHERE email = :currentEmail";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'email' => $newEmail,
            'currentEmail' => $currentEmail
        ]);
    }

    public function deleteUser($email) {
        $sql = "DELETE FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
    }
    
}

?>