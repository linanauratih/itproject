<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kategori extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Kategori'
        ];

        return view('admin/barang/kategori', $data);
    }
}
