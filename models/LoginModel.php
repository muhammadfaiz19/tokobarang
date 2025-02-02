<?php

include_once('db/database.php');

class LoginModel
{
    private $db;
                         
    public function __construct()
    {
        $this->db = new Database();
    }

    public function login_validation($email, $sandi) {

        $sql = "SELECT id, email, nama, sandi, level FROM users WHERE email = :email";
        $params = array(":email" => $email);
        $stmt = $this->db->executeQuery($sql, $params);
        
        if ($stmt !== false && !empty($stmt))  {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['sandi'];
            $nama = $row['nama'];
            $level = $row['level'];
    
            if (password_verify($sandi, $hashed_password)) { // verify passwords
                $_SESSION['nama'] = $nama;
                $_SESSION['email'] = $email;
                $_SESSION['level'] = $level;

                $response = array(
                    "success" => true,
                    "message" => "Login successful"
                );
            } else {
                $response = array(
                    "success" => false,
                    "message" => "Invalid password",
                    "query" => $stmt
                );
            }
        } else {
            $response = array(
                "success" => false,
                "message" => "User not found"
            );
        }
        
        return json_encode($response);
    }
    public function addUsers($email,$nama,$sandi)
    {
        $sql = "INSERT INTO users (email, nama, sandi) VALUES (:email,:nama,:sandi)";
        $pwd = password_hash($sandi, PASSWORD_BCRYPT);
        $params = array(
          ":email" => $email,
          ":nama" => $nama,
          ":sandi" => $pwd,
          );

        $result= $this->db->executeQuery($sql, $params);
        // Check if the insert was successful
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Insert successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Insert failed"
            );
        }
    
        // Return the response as JSON
        return json_encode($response);
    }  
}
