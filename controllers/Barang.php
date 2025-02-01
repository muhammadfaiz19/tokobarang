<?php
include_once('../models/BarangModel.php');

class BarangController
{
    private $model;

    public function __construct()
    {
        $this->model = new BarangModel();
    }

    public function addBarang($kode_barang, $nama_barang, $kategori, $harga, $stok)
    {
        return $this->model->addBarang($kode_barang, $nama_barang, $kategori, $harga, $stok);
    }

    public function getBarang($id)
    {
        return $this->model->getBarang($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getBarang($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateBarang($id, $kode_barang, $nama_barang, $kategori, $harga, $stok)
    {
        return $this->model->updateBarang($id, $kode_barang, $nama_barang, $kategori, $harga, $stok);
    }

    public function deleteBarang($id)
    {
        return $this->model->deleteBarang($id);
    }

    public function getBarangList()
    {
        return $this->model->getBarangList();
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
