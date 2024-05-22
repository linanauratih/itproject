<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Barang;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard'
        ];
    
        $model = new M_Barang(); // Menggunakan "new" untuk membuat instansi model
        $data['barang'] = $model->getdata(); // Mengambil data barang dari metode getdata()
    
        return view('admin/dashboard/index', $data);
    }
}
