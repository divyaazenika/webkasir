<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    protected $pelangganmodel;

    public function __construct(){
        $this->pelangganmodel= new PelangganModel();
    }
    public function index()
    {
        return view ('pelanggan/v_pelanggan');
    }
    public function simpan_pelanggan()
    {
    $validation = \Config\Services::validation();

    $validation->setRules([
        'nama_pelanggan'    => 'required',
        'alamat'            => 'required',
        'telepon'           => 'required',
    ]);
    if(!$validation->withRequest($this->request)->run()){
        return $this->response->setJSON([
            'status'        => 'error',
            'errors'        => $validation->getErrors()
        ]);
    }
    
    $data = [
        'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
        'alamat' => $this->request->getVar('alamat'),
        'telepon'  => $this->request->getVar('telepon'),
    ];

    $this->pelangganmodel->save($data);

    return $this->response->setJSON([
        'status'    => 'success',
        'message'   => 'Data pelanggan berhasil disimpan',
    ]);
}
public function tampil_pelanggan()
{
 $pelanggan = $this->pelangganmodel->findAll();
 
 return $this->response->setJSON([
     'status'    => 'success',
     'pelanggan'    => $pelanggan
 ]);
 }
 public function hapus_pelanggan($id)
{
    // Cek apakah produk dengan ID yang diberikan ada di database
    $pelanggan = $this->pelangganmodel->find($id);
    if (!$pelanggan) {
        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'pelanggan tidak ditemukan',
        ]);
    }

    // Hapus produk
    if ($this->pelangganmodel->delete($id)) {
        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'pelanggan berhasil dihapus',
        ]);
    } else {
        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Gagal menghapus produk',
        ]);
    }
}
public function update_pelanggan()
{
    $id = $this->request->getVar('id_pelanggan');
    $data = [
        'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
        'alamat'       => $this->request->getVar('alamat'),
        'telepon'        => $this->request->getVar('telepon'),
    ];

    if ($this->pelangganmodel->update($id, $data)) {
        return $this->response->setJSON(['status' => 'success', 'message' => 'pelanggan berhasil diperbarui']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui pelanggan']);
    }
}

}