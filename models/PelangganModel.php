<?php

include_once('../db/database.php');

class PelangganModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addPelanggan($kode_pelanggan, $nama, $jk, $email, $telepon)
    {
        $sql = "INSERT INTO pelanggan (kode_pelanggan, nama, jk, email, telepon) VALUES (:kode_pelanggan, :nama, :jk, :email, :telepon)";
        $params = array(
          ":kode_pelanggan" => $kode_pelanggan,
          ":nama" => $nama,
          ":jk" => $jk,
          ":email" => $email,
          ":telepon" => $telepon
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

    public function getPelanggan($id)
    {
        $sql = "SELECT * FROM pelanggan WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePelanggan($id, $kode_pelanggan, $nama, $jk, $email, $telepon)
    {
        $sql = "UPDATE pelanggan SET kode_pelanggan = :kode_pelanggan, nama = :nama, jk = :jk, email = :email, telepon = :telepon WHERE id = :id";
        $params = array(
          ":kode_pelanggan" => $kode_pelanggan,
          ":nama" => $nama,
          ":jk" => $jk,
          ":email" => $email,
          ":telepon" => $telepon,
          ":id" => $id
        );
    
        // Execute the query
        $result = $this->db->executeQuery($sql, $params);
    
        // Check if the update was successful
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Update successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Update failed"
            );
        }
    
        // Return the response as JSON
        return json_encode($response);
    }
    

    public function deletePelanggan($id)
    {
        $sql = "DELETE FROM pelanggan WHERE id = :id";
        $params = array(":id" => $id);

        $result = $this->db->executeQuery($sql, $params);
        // Check if the delete was successful
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Delete successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Delete failed"
            );
        }
    
        // Return the response as JSON
        return json_encode($response);
    }

    public function getPelangganList()
    {
        $sql = 'SELECT * FROM pelanggan limit 100';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM pelanggan';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
