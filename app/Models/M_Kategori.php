<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    public function getAllKategori()
    {
        return $this->findAll(); // Mengambil semua data dari tabel satuan
    }
    public function getKategoriByBarang($id_barang)
{
    return $this->where('id_barang', $id_barang)->findAll();
}

}
