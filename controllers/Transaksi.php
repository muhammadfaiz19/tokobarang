<?php
include_once('../models/TransaksiModel.php');

class TransaksiController
{
    private $model;

    public function __construct()
    {
        $this->model = new TransaksiModel();
    }

    public function addTransaksi($kode_transaksi, $kode_pelanggan, $tanggal_transaksi)
    {
        return $this->model->addTransaksi($kode_transaksi, $kode_pelanggan, $tanggal_transaksi);
    }

    public function getTransaksi($id)
    {
        return $this->model->getTransaksi($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getTransaksi($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateTransaksi($id, $kode_transaksi, $kode_pelanggan, $tanggal_transaksi)
    {
        return $this->model->updateTransaksi($id, $kode_transaksi, $kode_pelanggan, $tanggal_transaksi);
    }

    public function updateStatus($id, $status)
    {
        return $this->model->updateStatus($id, $status);
    }

    public function deleteTransaksi($id)
    {
        return $this->model->deleteTransaksi($id);
    }

    public function getTransaksiList()
    {
        return $this->model->getTransaksiList();
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
