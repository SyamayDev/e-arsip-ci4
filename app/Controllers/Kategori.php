<?php

namespace App\Controllers;

use App\Models\Model_kategori;

class Kategori extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Model_kategori = new Model_kategori();
    }

    public function index()
    {
        $data = array(
            'title' => 'Kategori',
            'kategori' => $this->Model_kategori->all_data(),
            'isi' => 'v_kategori'
        );
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        if ($this->validate([
            'nama_kategori' => [
                'label' => 'Nama Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                ],
            ],
        ])) {
            $data = [
                'nama_kategori' => $this->request->getPost('nama_kategori'),
            ];
            $this->Model_kategori->add($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('kategori'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('kategori'));
        }
    }

    public function update($id_kategori)
    {
        if ($this->validate([
            'nama_kategori' => [
                'label' => 'Nama Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                ],
            ],
        ])) {
            $data = [
                'id_kategori' => $id_kategori,
                'nama_kategori' => $this->request->getPost('nama_kategori'),
            ];
            $this->Model_kategori->edit($data);
            session()->setFlashdata('pesan', 'Data Berhasil Diubah !!!');
            return redirect()->to(base_url('kategori'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('kategori'));
        }
    }
    public function delete($id_kategori)
    {
        // ambil data kategori berdasarkan id
        $kategori = $this->Model_kategori->detail_data($id_kategori);

        // hapus data
        $this->Model_kategori->delete_data(['id_kategori' => $id_kategori]);

        // kasih pesan flash dengan nama kategori yang dihapus
        session()->setFlashdata('pesan', 'Kategori ' . $kategori['nama_kategori'] . ' Berhasil Dihapus !!!');
        return redirect()->to(base_url('kategori'));
    }

    //--------------------------------------------------------------------

}
