<?php

include_once('../db/database.php');

class DetailtransaksiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addDetailtransaksi($transaksi_id, $kode_barang)
    {
        $sql = "INSERT INTO detailtransaksi (transaksi_id, kode_barang) VALUES (:transaksi_id, :kode_barang)";
        $params = array(
          ":transaksi_id" => $transaksi_id,
          ":kode_barang" => $kode_barang
        );

        $result = $this->db->executeQuery($sql, $params);
        
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
    
        return json_encode($response);
    }

    public function getDetailtransaksi($id)
    {
        $sql = "SELECT T.id, T.transaksi_id, T.kode_barang, B.id as idbarang, B.kode_barang, B.nama_barang, B.kategori, B.harga
                FROM detailtransaksi T
                LEFT JOIN barang B ON T.kode_barang = B.kode_barang 
                WHERE T.id = :id";
        $params = array(":id" => $id);
        
        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateDetailtransaksi($id, $kode_transaksi, $kode_barang)
    {
        $sql = "UPDATE detailtransaksi 
                SET kode_transaksi = :kode_transaksi, kode_barang = :kode_barang 
                WHERE id = :id";
        $params = array(
          ":kode_transaksi" => $kode_transaksi,
          ":kode_barang" => $kode_barang,
          ":id" => $id
        );
    
        $result = $this->db->executeQuery($sql, $params);
    
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
    
        return json_encode($response);
    }
    

    public function deleteDetailtransaksi($id)
    {
        $sql = "DELETE FROM detailtransaksi WHERE id = :id";
        $params = array(":id" => $id);

        $result = $this->db->executeQuery($sql, $params);
        
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
    
        return json_encode($response);
    }

    public function getDetailtransaksiList($id)
    {
        $sql = "SELECT T.id, T.transaksi_id, T.kode_barang, B.id as idbarang, B.kode_barang, B.nama_barang, B.kategori, B.harga 
                FROM detailtransaksi T
                LEFT JOIN barang B ON T.kode_barang = B.kode_barang
                WHERE T.transaksi_id = :transaksi_id";
        
        $params = array(":transaksi_id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM detailtransaksi';
        $data = $this->db->executeQuery($sql, array())->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function countDetailtransaksi($transaksi_id)
    {
        $sql = "SELECT COUNT(*) as jumlah FROM detailtransaksi WHERE transaksi_id = :transaksi_id";
        $params = array(":transaksi_id" => $transaksi_id);

        return $this->db->executeQuery($sql, $params)->fetchColumn();
    }

    public function isValidTransaksi($transaksi_id)
    {
        $sql = "SELECT COUNT(*) FROM transaksi WHERE id = :transaksi_id";
        $params = array(":transaksi_id" => $transaksi_id);
        
        $count = $this->db->executeQuery($sql, $params)->fetchColumn();
        return $count > 0; // return true if transaksi_id exists, otherwise false
    }
}
?>
