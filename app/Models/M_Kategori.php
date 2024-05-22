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
}
