<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Satuan extends Model
{
    protected $table = 'satuan';
    protected $primaryKey = 'id_satuan';

    public function getAllSatuan()
    {
        return $this->findAll(); // Mengambil semua data dari tabel satuan
    }
}
