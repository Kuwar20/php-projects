<?php
    require_once 'config.php';

    class Database{
        private const DSN = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME;
        private $conn;    
        
        public function __construct(){
            try{
                $this->conn = new PDO(self::DSN,DB_USER,DB_PASS);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // echo 'Connected Successfully';
            }catch(PDOException $e){
                die('Connection Error: '.$e->getMessage());
            }
        }
    }
    // $DbObj = new Database; // commented statement are helpful for checking if the db connection is successful or not
?>