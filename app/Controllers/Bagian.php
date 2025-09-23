<?php

namespace App\Controllers;

use App\Models\Model_bagian;

class Bagian extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Model_bagian = new Model_bagian();
    }

    public function index()
    {
        $data = array(
            'title' => 'Bagian',
            'bagian' => $this->Model_bagian->all_data(),
            'isi' => 'v_bagian'
        );
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'nama_bagian' => $this->request->getPost(),
        );
        $this->Model_bagian->add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        return redirect()->to(base_url('bagian'));
    }

    public function edit($id_bagian)
    {
        $data = array(
            'id_bagian' => $id_bagian,
            'nama_bagian' => $this->request->getPost('nama_bagian'),
        );
        $this->Model_bagian->edit( $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !!!');
        return redirect()->to(base_url('bagian'));
    }
    public function delete($id_bagian)
    {
        // ambil data bagian berdasarkan id
        $bagian = $this->Model_bagian->detail_data($id_bagian);

        // hapus data
        $this->Model_bagian->delete_data(['id_bagian' => $id_bagian]);

        // kasih pesan flash dengan nama bagian yang dihapus
        session()->setFlashdata('pesan', 'Bagian ' . $bagian['nama_bagian'] . ' Berhasil Dihapus !!!');
        return redirect()->to(base_url('bagian'));
    }

    //--------------------------------------------------------------------

}
