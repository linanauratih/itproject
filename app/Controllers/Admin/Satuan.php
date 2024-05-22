<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Satuan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Satuan'
        ];

        return view('admin/barang/satuan', $data);
    }
}
