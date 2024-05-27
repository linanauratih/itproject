<?php

namespace App\Models;

use CodeIgniter\Model;
class M_BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_keluar';
    protected $allowedFields = ['jumlah_stok', 'tanggal', 'harga_jual','id_barang','id_satuan', 'id_merk', 'id_kategori'];

    public function getdata()
    {
        // join dengan tabel satuan, merk, dan kategori
        $builder = $this->db->table('barang_keluar');
        $builder->select('barang_keluar.*, barang.nama AS nama_barang, satuan.satuan AS nama_satuan, merk.merk AS nama_merk, kategori.kategori AS nama_kategori');
        $builder->join('barang', 'barang.id_barang = barang_keluar.id_barang');
        $builder->join('satuan', 'satuan.id_satuan = barang_keluar.id_satuan');
        $builder->join('merk', 'merk.id_merk = barang_keluar.id_merk');
        $builder->join('kategori', 'kategori.id_kategori = barang_keluar.id_kategori');
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
    

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
