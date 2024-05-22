<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Merk extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Merk'
        ];

        return view('admin/barang/merk', $data);
    }
}
