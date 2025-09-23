<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_bagian extends Model
{
    public function all_data()
    {
        return $this->db->table('tbl_bagian')->orderBy('id_bagian', 'DESC')->get()->getResultArray();
    }
    public function add($data)
    {
        $this->db->table('tbl_bagian')->insert($data);
    }
    public function edit($data)
    {
        $this->db->table('tbl_bagian')
            ->where('id_bagian', $data['id_bagian'])
            ->update($data);
    }
    public function delete_data($data)
    {
        $this->db->table('tbl_bagian')
            ->where('id_bagian', $data['id_bagian'])
            ->delete($data);
    }
    public function detail_data($id_bagian)
    {
        return $this->db->table('tbl_bagian')
            ->where('id_bagian', $id_bagian)
            ->get()
            ->getRowArray();
    }

}
