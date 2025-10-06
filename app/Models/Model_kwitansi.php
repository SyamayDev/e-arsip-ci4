<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_kwitansi extends Model
{
    protected $table            = 'tbl_kwitansi';
    protected $primaryKey       = 'id_kwitansi';
    protected $allowedFields    = [
        'no_kwitansi',
        'tanggal',
        'telah_diterima_dari',
        'uang_sejumlah',
        'untuk_keperluan',
        'terbilang'
    ];

    public function get_all_data()
    {
        return $this->findAll();
    }

    public function get_data($id_kwitansi)
    {
        return $this->find($id_kwitansi);
    }
}