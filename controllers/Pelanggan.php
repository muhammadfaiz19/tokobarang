<?php
include_once('../models/PelangganModel.php');

class PelangganController
{
    private $model;

    public function __construct()
    {
        $this->model = new PelangganModel();
    }

    public function addPelanggan($kode_pelanggan, $nama, $jk, $email, $telepon)
    {
        return $this->model->addPelanggan($kode_pelanggan, $nama, $jk, $email, $telepon);
    }

    public function getPelanggan($id)
    {
        return $this->model->getPelanggan($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getPelanggan($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updatePelanggan($id, $kode_pelanggan, $nama, $jk, $email, $telepon)
    {
        return $this->model->updatePelanggan($id, $kode_pelanggan, $nama, $jk, $email, $telepon);
    }

    public function deletePelanggan($id)
    {
        return $this->model->deletePelanggan($id);
    }

    public function getPelangganList($search = '', $jk = '')
    {
    return $this->model->getPelangganList($search, $jk);
    }

    public function getJenisKelamin()
    {
        return [
            ['jk' => 'L'],
            ['jk' => 'P']
        ];
    }

    public function getTotalPelanggan()
    {
        return $this->model->getTotalPelanggan();
    }
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
