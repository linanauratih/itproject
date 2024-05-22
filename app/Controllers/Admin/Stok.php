<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Barang;
use App\Models\M_Satuan;
use App\Models\M_Kategori;
use App\Models\M_Merk;

class Stok extends BaseController
{
    protected $model;
    protected $satuanModel;
    protected $data;
    protected $merkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->model = new M_Barang();
        $this->satuanModel = new M_Satuan();
        $this->kategoriModel = new M_Kategori();
        $this->merkModel = new M_Merk();
        
        $this->data['title'] = 'Stok Barang';
        $this->data['row'] = $this->model->getdata();
    }

    public function index()
{
    $data = [
        'title' => $this->data['title'],
        'barang' => $this->model->getdata(),
        'satuan' => $this->satuanModel->getAllSatuan(),
        'kategori' => $this->kategoriModel->getAllKategori(),
        'merk' => $this->merkModel->getAllMerk(),
    ];

    return view('admin/barang/stok', $data);
}
public function tambah()
{
    // Ambil data dari formulir
    $nama = $this->request->getPost('nama');
    $jumlah = $this->request->getPost('jumlah_stok');
    $harga = $this->request->getPost('harga');
    $id_satuan = $this->request->getPost('id_satuan');
    $id_kategori = $this->request->getPost('id_kategori');
    $id_merk = $this->request->getPost('id_merk');
    
    // Validasi data
    if (empty($nama) || empty($jumlah) || empty($harga) || empty($id_satuan) || empty($id_kategori) || empty($id_merk)) {
        // Jika ada data yang kosong, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Semua field harus diisi.');
        // Redirect kembali ke halaman tambah stok
        return redirect()->to(base_url('barang'));
    }

    // Validasi jumlah harus bilangan positif
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        // Jika jumlah tidak valid, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Jumlah harus berupa bilangan positif.');
        // Redirect kembali ke halaman tambah stok
        return redirect()->to(base_url('barang'));
    }

    // Validasi harga harus bilangan positif
    if (!is_numeric($harga) || $harga <= 0) {
        // Jika harga tidak valid, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Harga harus berupa bilangan positif.');
        // Redirect kembali ke halaman tambah stok
        return redirect()->to(base_url('barang'));
    }
    
    // Panggil model untuk menambahkan data stok
    $data = [
        'nama' => $nama,
        'jumlah_stok' => $jumlah,
        'harga' => $harga,
        'id_satuan' => $id_satuan,
        'id_kategori' => $id_kategori,
        'id_merk' => $id_merk
    ];

    $this->model->tambahStok($data);

    // Set pesan flash untuk memberi tahu pengguna bahwa data berhasil ditambahkan
    session()->setFlashdata('success', 'Data berhasil ditambahkan.');

    // Redirect ke halaman yang sesuai, misalnya ke halaman daftar stok
    return redirect()->to(base_url('barang'));
}


public function edit($id_barang)
{
    // Ambil data barang berdasarkan ID
    $data['row'] = $this->model->getBarangById($id_barang);

    // Validasi data
    if (empty($data['row'])) {
        // Jika data barang tidak ditemukan, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Data barang tidak ditemukan.');
        // Redirect ke halaman yang sesuai
        return redirect()->to(base_url('barang'));
    }

    // Ambil data dari formulir (jika diperlukan)
    $nama = $this->request->getPost('nama');
    $jumlah = $this->request->getPost('jumlah_stok');
    $harga = $this->request->getPost('harga');
    $id_satuan = $this->request->getPost('satuan');
    $id_kategori = $this->request->getPost('kategori');
    $id_merk = $this->request->getPost('merk');
    
    // Validasi data
    if (empty($nama) || empty($jumlah) || empty($harga) || empty($id_satuan) || empty($id_kategori) || empty($id_merk)) {
        // Jika ada data yang kosong, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Semua field harus diisi.');
        // Redirect kembali ke halaman edit stok
        return redirect()->to(base_url('barang/edit/' . $id_barang));
    }

    // Validasi jumlah harus bilangan positif
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        // Jika jumlah tidak valid, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Jumlah harus berupa bilangan positif.');
        // Redirect kembali ke halaman edit stok
        return redirect()->to(base_url('barang/edit/' . $id_barang));
    }

    // Validasi harga harus bilangan positif
    if (!is_numeric($harga) || $harga <= 0) {
        // Jika harga tidak valid, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Harga harus berupa bilangan positif.');
        // Redirect kembali ke halaman edit stok
        return redirect()->to(base_url('barang/edit/' . $id_barang));
    }
    
    // Panggil model untuk mengupdate data stok
    $update_data = [
        'nama' => $nama,
        'jumlah_stok' => $jumlah,
        'harga' => $harga,
        'id_satuan' => $id_satuan,
        'id_kategori' => $id_kategori,
        'id_merk' => $id_merk
    ];

    $this->model->updateStok($id_barang, $update_data);

    // Set pesan flash untuk memberi tahu pengguna bahwa data berhasil diupdate
    session()->setFlashdata('success', 'Data berhasil diupdate.');

    // Redirect ke halaman yang sesuai, misalnya ke halaman daftar stok
    return redirect()->to(base_url('barang'));
}


    public function delete($id)
    {
        $this->model->deleteStok($id);
        return redirect()->to('barang');
    }
}
