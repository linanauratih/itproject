<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_BarangKeluar;
use App\Models\M_Satuan;
use App\Models\M_Kategori;
use App\Models\M_Merk;
use App\Models\M_Barang;

class BarangKeluar extends BaseController
{
    protected $model;
    protected $satuanModel;
    protected $data;
    protected $merkModel;
    protected $kategoriModel;
    protected $barangModel;

    public function __construct()
    {
        $this->model = new M_BarangKeluar();
        $this->satuanModel = new M_Satuan();
        $this->kategoriModel = new M_Kategori();
        $this->merkModel = new M_Merk();
        $this->barangModel = new M_Barang();
        
        $this->data['title'] = 'Barang Keluar';
        $this->data['row'] = $this->model->getdata();
    }

    public function index()
{
    $data = [
        'title' => $this->data['title'],
        'barang_keluar' => $this->model->getdata(),
        'masuk' => $this->model->getAlldata(),
        'barang' => $this->barangModel->getAllBarang(),
        'satuan' => $this->satuanModel->getAllSatuan(),
        'kategori' => $this->kategoriModel->getAllKategori(),
        'merk' => $this->merkModel->getAllMerk(),
    ];

    return view('admin/barangkeluar/index', $data);
}
public function tambah()
{
    // Ambil data dari formulir
    $nama = $this->request->getPost('nama');
    $jumlah = $this->request->getPost('jumlah_stok');
    $tanggal = $this->request->getPost('tanggal');
    $id_satuan = $this->request->getPost('id_satuan');
    $id_kategori = $this->request->getPost('id_kategori');
    $id_merk = $this->request->getPost('id_merk');
    
    // Validasi data
    if (empty($nama) || empty($jumlah) || empty($tanggal) || empty($id_satuan) || empty($id_kategori) || empty($id_merk)) {
        // Jika ada data yang kosong, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Semua field harus diisi.');
        // Redirect kembali ke halaman tambah stok
        return redirect()->to(base_url('barangmasuk'));
    }

    // Validasi jumlah harus bilangan positif
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        // Jika jumlah tidak valid, tampilkan pesan kesalahan
        session()->setFlashdata('error', 'Jumlah harus berupa bilangan positif.');
        // Redirect kembali ke halaman tambah stok
        return redirect()->to(base_url('barangmasuk'));
    }
    
    // Panggil model untuk menambahkan data stok
    $data = [
        'nama' => $nama,
        'jumlah_stok' => $jumlah,
        'tanggal' => $tanggal,
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

public function edit()
{
    // Ambil data dari formulir
    $id_barang = $this->request->getPost('id_barang');
    $nama = $this->request->getPost('nama');
    $jumlah = $this->request->getPost('jumlah_stok');
    $id_satuan = $this->request->getPost('id_satuan');
    $id_kategori = $this->request->getPost('id_kategori');
    $id_merk = $this->request->getPost('id_merk');
    
    // Validasi data
    if (empty($id_barang) || empty($nama) || empty($jumlah) || empty($id_satuan) || empty($id_kategori) || empty($id_merk)) {
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
    
    // Panggil model untuk mengupdate data stok
    $data = [
        'nama' => $nama,
        'jumlah_stok' => $jumlah,
        'id_satuan' => $id_satuan,
        'id_kategori' => $id_kategori,
        'id_merk' => $id_merk
    ];

    $this->model->updateStok($id_barang, $data);

    // Set pesan flash untuk memberi tahu pengguna bahwa data berhasil diupdate
    session()->setFlashdata('success', 'Data berhasil diupdate.');

    // Redirect ke halaman yang sesuai, misalnya ke halaman daftar stok
    return redirect()->to(base_url('barangmasuk'));
}
    public function delete($id)
    {
        $this->model->hapus($id);
        return redirect()->to('barangkeluar');
    }
}