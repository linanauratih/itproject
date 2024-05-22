<?php

namespace App\Models;

use CodeIgniter\Model;
class M_BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_masuk';
    protected $allowedFields = ['jumlah_stok', 'tanggal', 'harga','id_barang','id_satuan', 'id_merk', 'id_kategori'];

    public function getdata()
    {
        // join dengan tabel satuan, merk, dan kategori
        $builder = $this->db->table('barang_masuk');
        $builder->select('barang_masuk.*, barang.nama AS nama_barang, satuan.satuan AS nama_satuan, merk.merk AS nama_merk, kategori.kategori AS nama_kategori');
        $builder->join('barang', 'barang.id_barang = barang_masuk.id_barang');
        $builder->join('satuan', 'satuan.id_satuan = barang_masuk.id_satuan');
        $builder->join('merk', 'merk.id_merk = barang_masuk.id_merk');
        $builder->join('kategori', 'kategori.id_kategori = barang_masuk.id_kategori');
        return $builder->get()->getResultArray();
    }

    public function getStokBarangById($id)
    {
        return $this->find($id);

    }
    public function getAlldata()
    {
        return $this->findAll();

    }

    public function tambahBarangMasuk($data)
    {
        return $this->insert($data);
    }
    public function updateBarangMasuk($id_barang, $data)
    {
        return $this->update($id_barang, $data);
    }
    

    public function deleteBarangMasuk($id)
    {
        return $this->delete($id);
    }
}
