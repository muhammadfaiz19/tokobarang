<?php
include_once('../models/BarangModel.php');

class BarangController
{
    private $model;

    public function __construct()
    {
        $this->model = new BarangModel();
    }

    // Add Barang
    public function addBarang($kode_barang, $nama_barang, $kategori, $harga, $stok)
    {
        return $this->model->addBarang($kode_barang, $nama_barang, $kategori, $harga, $stok);
    }

    // Get Barang by ID
    public function getBarang($id)
    {
        return $this->model->getBarang($id);
    }

    // Update Barang
    public function updateBarang($id, $kode_barang, $nama_barang, $kategori, $harga, $stok)
    {
        return $this->model->updateBarang($id, $kode_barang, $nama_barang, $kategori, $harga, $stok);
    }

    // Delete Barang
    public function deleteBarang($id)
    {
        return $this->model->deleteBarang($id);
    }

    // Get Barang List with Search and Filter
    public function getBarangList()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
        return $this->model->getBarangList($search, $kategori);
    }

    // Get Data for ComboBox
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }

    // Get Categories for Filter
    public function getCategories()
    {
        return $this->model->getCategories();
    }

    public function getBarangByKode($kode_barang)
    {
        return $this->model->getBarangByKode($kode_barang);
    }

    public function kurangiStokBarang($kode_barang, $jumlah)
    { 
        return $this->model->kurangiStokBarang($kode_barang, $jumlah);
    }

    public function updatefotoBarang($id, $foto){
        return $this->model->updatefotoBarang($id, $foto);
    }
    
}
