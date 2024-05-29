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
}

?>