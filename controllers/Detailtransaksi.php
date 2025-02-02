<?php
include_once('../models/DetailtransaksiModel.php');

class DetailtransaksiController
{
    private $model;

    public function __construct()
    {
        $this->model = new DetailtransaksiModel();
    }

    public function addDetailtransaksi($transaksi_id, $kode_barang)
    {
        // Add detail transaksi and return response (could be success or failure)
        $response = $this->model->addDetailtransaksi($transaksi_id, $kode_barang);
        return json_decode($response, true);  // Decode JSON response from the model for further handling
    }

    public function getDetailtransaksi($id)
    {
        return $this->model->getDetailtransaksi($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getDetailtransaksi($id);
        foreach($rows as $row){
            $val = $row['nama_pelanggan'];
        }
        return $val;
    }

    public function updateDetailtransaksi($id, $transaksi_id, $kode_barang)
    {
        return $this->model->updateDetailtransaksi($id, $transaksi_id, $kode_barang);
    }

    public function deleteDetailtransaksi($id, $transaksi_id)
    {
        // Hapus detail transaksi
        $response = $this->model->deleteDetailtransaksi($id, $transaksi_id);

        // Perbarui total harga setelah penghapusan
        $this->model->updateTotalHarga($transaksi_id);

        return json_decode($response, true);
    }

    public function getDetailtransaksiList($id)
    {
        // Get the list of detail transaksi for a given transaksi ID
        $rows = $this->model->getDetailtransaksiList($id);
        if (count($rows) > 0) {
            return $rows;
        } else {
            return [];  // Return an empty array if no details found
        }
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }

    public function countDetailtransaksi($id)
    {
        return $this->model->countDetailtransaksi($id);
    }

    public function isValidTransaksi($id)
    {
        return $this->model->isValidTransaksi($id);
    }

    public function updateTotalHarga($transaksi_id)
    {
        return $this->model->updateTotalHarga($transaksi_id);
    }

    public function getTotalHarga($id)
    {
        return $this->model->getTotalHarga($id);
    }
}
?>
