<?php

include_once('../db/database.php');

class BarangModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Add Barang
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

        $result = $this->db->executeQuery($sql, $params);
        if ($result) {
            return json_encode(["success" => true, "message" => "Insert successful"]);
        } else {
            return json_encode(["success" => false, "message" => "Insert failed"]);
        }
    }

    // Get Barang by ID
    public function getBarang($id)
    {
        $sql = "SELECT * FROM barang WHERE id = :id";
        $params = [":id" => $id];
        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update Barang
    public function updateBarang($id, $kode_barang, $nama_barang, $kategori, $harga, $stok)
    {
        $sql = "UPDATE barang SET kode_barang = :kode_barang, nama_barang = :nama_barang, kategori = :kategori, harga = :harga, stok = :stok WHERE id = :id";
        $params = [
            ":kode_barang" => $kode_barang,
            ":nama_barang" => $nama_barang,
            ":kategori" => $kategori,
            ":harga" => $harga,
            ":stok" => $stok,
            ":id" => $id
        ];

        $result = $this->db->executeQuery($sql, $params);
        return json_encode($result ? ["success" => true, "message" => "Update successful"] : ["success" => false, "message" => "Update failed"]);
    }

    // Delete Barang
    public function deleteBarang($id)
    {
        $sql = "DELETE FROM barang WHERE id = :id";
        $params = [":id" => $id];

        $result = $this->db->executeQuery($sql, $params);
        return json_encode($result ? ["success" => true, "message" => "Delete successful"] : ["success" => false, "message" => "Delete failed"]);
    }

    // Get Barang List with Search and Filter
    public function getBarangList($search = '', $kategori = '')
    {
        // Base SQL query
        $sql = 'SELECT * FROM barang WHERE 1';
    
        // Add search condition if search is provided
        if ($search) {
            $sql .= ' AND (kode_barang LIKE :search OR nama_barang LIKE :search)';
        }
    
        // Add category filter if category is provided
        if ($kategori) {
            $sql .= ' AND kategori = :kategori';
        }
    
        // Prepare the query using the PDO instance
        $stmt = $this->db->getPdo()->prepare($sql);
    
        // Bind parameters
        if ($search) {
            $stmt->bindValue(':search', '%' . $search . '%');
        }
    
        if ($kategori) {
            $stmt->bindValue(':kategori', $kategori);
        }
    
        // Execute the query
        $stmt->execute();
    
        // Return the results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCategories()
    {
        // Get unique categories from the database
        $sql = "SELECT DISTINCT kategori FROM barang";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Get Data for ComboBox (Dropdown)
    public function getDataCombo()
    {
        $sql = 'SELECT * FROM barang';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getBarangByKode($kode_barang) {
        $sql = "SELECT * FROM barang WHERE kode_barang = :kode_barang";  // Use named placeholder
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->bindParam(":kode_barang", $kode_barang, PDO::PARAM_STR);  // Bind the parameter
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function kurangiStokBarang($kode_barang, $jumlah) {
        $sql = "UPDATE barang SET stok = stok - :jumlah WHERE kode_barang = :kode_barang AND stok >= :jumlah";
        
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->bindParam(":kode_barang", $kode_barang, PDO::PARAM_STR);
        $stmt->bindParam(":jumlah", $jumlah, PDO::PARAM_INT);
    
        return $stmt->execute();
    }

    public function updatefotoBarang($id, $foto)
    {
        $sql = "UPDATE barang SET foto = :foto WHERE id = :id";
        $params = array(
          ":foto" => $foto,
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

}
