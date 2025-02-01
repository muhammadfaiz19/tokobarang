<?php

include_once('../db/database.php');

class BarangModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addBarang($kode_barang, $nama_barang, $kategori, $harga, $stok)
    {
        $sql = "INSERT INTO barang (kode_barang, nama_barang, kategori, harga, stok) VALUES (:kode_barang, :nama_barang, :kategori, :harga, :stok)";
        $params = array(
          ":kode_barang" => $kode_barang,
          ":nama_barang" => $nama_barang,
          ":kategori" => $kategori,
          ":harga" => $harga,
          ":stok" => $stok
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

    public function getBarang($id)
    {
        $sql = "SELECT * FROM barang WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateBarang($id, $kode_barang, $nama_barang, $kategori, $harga, $stok)
    {
        $sql = "UPDATE barang SET kode_barang = :kode_barang, nama_barang = :nama_barang, kategori = :kategori, harga = :harga, stok = :stok WHERE id = :id";
        $params = array(
          ":kode_barang" => $kode_barang,
          ":nama_barang" => $nama_barang,
          ":kategori" => $kategori,
          ":harga" => $harga,
          ":stok" => $stok,
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
    

    public function deleteBarang($id)
    {
        $sql = "DELETE FROM barang WHERE id = :id";
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

    public function getBarangList()
    {
        $sql = 'SELECT * FROM barang limit 100';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM barang';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
