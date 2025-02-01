<?php

include_once('../db/database.php');

class TransaksiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addTransaksi($kode_transaksi, $kode_pelanggan, $tanggal_transaksi)
    {
        $sql = "INSERT INTO transaksi (kode_transaksi, kode_pelanggan, tanggal_transaksi) 
                SELECT :kode_transaksi, :kode_pelanggan, :tanggal_transaksi
                FROM pelanggan P
                LEFT JOIN transaksi T ON T.kode_pelanggan = P.kode_pelanggan 
                WHERE P.kode_pelanggan = :kode_pelanggan";
        
        $params = array(
            ":kode_transaksi" => $kode_transaksi,
            ":kode_pelanggan" => $kode_pelanggan,
            ":tanggal_transaksi" => $tanggal_transaksi
        );

        $result = $this->db->executeQuery($sql, $params);
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


    public function getTransaksi($id)
    {
        $sql = "SELECT T.*,P.nama FROM transaksi T left join pelanggan P on (T.kode_pelanggan = P.kode_pelanggan) WHERE T.id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTransaksi($id, $kode_transaksi, $kode_pelanggan, $tanggal_transaksi)
    {
        $sql = "UPDATE transaksi SET kode_transaksi = :kode_transaksi, kode_pelanggan = :kode_pelanggan, tanggal_transaksi = :tanggal_transaksi WHERE id = :id";
        $params = array(
          ":kode_transaksi" => $kode_transaksi,
          ":kode_pelanggan" => $kode_pelanggan,
          ":tanggal_transaksi" => $tanggal_transaksi,
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
    
    public function updateStatus($id, $status)
    {
        try {
            $sql = "UPDATE transaksi SET dibeli = :dibeli WHERE id = :id";
            $params = array(":dibeli" => $status, ":id" => $id);

            $this->db->executeQuery($sql, $params);
            return json_encode(["success" => true, "message" => "Status updated"]);
        } catch (Exception $e) {
            return json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function deleteTransaksi($id)
    {
        $sql = "DELETE FROM transaksi WHERE id = :id";
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

    public function getTransaksiList()
    {
        $sql = 'SELECT T.id,T.kode_transaksi,T.kode_pelanggan,T.tanggal_transaksi, T.dibeli, P.id as idpelanggan,P.nama 
        FROM transaksi T left join pelanggan P on (T.kode_pelanggan = P.kode_pelanggan) limit 100';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getDataCombo()
    {
        $sql = 'SELECT * FROM transaksi';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
