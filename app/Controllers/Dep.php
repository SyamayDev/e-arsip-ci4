<?php

namespace App\Controllers;

use App\Models\Model_dep;

class Dep extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Model_dep = new Model_dep();
    }

    public function index()
    {
        $data = array(
            'title' => 'Departemen',
            'dep' => $this->Model_dep->all_data(),
            'isi' => 'v_dep'
        );
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'nama_dep' => $this->request->getPost(),
        );
        $this->Model_dep->add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        return redirect()->to(base_url('dep'));
    }

    public function edit($id_dep)
    {
        $data = array(
            'id_dep' => $id_dep,
            'nama_dep' => $this->request->getPost('nama_dep'),
        );
        $this->Model_dep->edit( $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !!!');
        return redirect()->to(base_url('dep'));
    }
    public function delete($id_dep)
    {
        // ambil data dep berdasarkan id
        $dep = $this->Model_dep->detail_data($id_dep);

        // hapus data
        $this->Model_dep->delete_data(['id_dep' => $id_dep]);

        // kasih pesan flash dengan nama dep yang dihapus
        session()->setFlashdata('pesan', 'dep ' . $dep['nama_dep'] . ' Berhasil Dihapus !!!');
        return redirect()->to(base_url('dep'));
    }

    //--------------------------------------------------------------------

}
