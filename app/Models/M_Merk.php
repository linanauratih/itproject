<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Merk extends Model
{
    protected $table = 'merk';
    protected $primaryKey = 'id_merk';

    public function getAllMerk()
    {
        return $this->findAll(); // Mengambil semua data dari tabel satuan
    }
}
