<?php
    class Util{

        // Method to sanitize input value
        public function sanitize($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }

        // Method to display success and error messages
        public function showMessage($type, $message){
            return '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
                    <strong>'.$message.'</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
?>