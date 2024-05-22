<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['nama', 'jumlah_stok', 'harga','id_satuan', 'id_merk', 'id_kategori'];

    public function getdata()
    {
        // Lakukan join dengan tabel satuan, merk, dan kategori
        $builder = $this->db->table('barang');
        $builder->select('barang.*, satuan.satuan AS nama_satuan, merk.merk AS nama_merk, kategori.kategori AS nama_kategori');
        $builder->join('satuan', 'satuan.id_satuan = barang.id_satuan');
        $builder->join('merk', 'merk.id_merk = barang.id_merk');
        $builder->join('kategori', 'kategori.id_kategori = barang.id_kategori');
        return $builder->get()->getResultArray();
    }

    public function getAllBarang()
    {
        return $this->findAll();
    }
    public function tambahStok($data)
    {
        return $this->insert($data);
    }


    public function getBarangByName($nama_barang)
    {
        return $this->where('nama', $nama_barang)->first();
    }

    public function tambahStokMasuk($id_barang, $jumlah)
    {
        $barang = $this->find($id_barang);
        if ($barang) {
            $stok_sekarang = $barang['jumlah_stok'];
            $stok_baru = $stok_sekarang + $jumlah;
            return $this->update($id_barang, ['jumlah_stok' => $stok_baru]);
        } else {
            log_message('error', 'Barang tidak ditemukan dengan ID: ' . $id_barang);
            return false;
        }
    }

    public function getBarangById($id_barang)
    {
        return $this->where('id_barang', $id_barang)->first();
    }

    public function updateStok($id_barang, $data)
    {
        return $this->update($id_barang, $data);
    }

    public function deleteStok($id)
    {
        return $this->delete($id);
    }

}
