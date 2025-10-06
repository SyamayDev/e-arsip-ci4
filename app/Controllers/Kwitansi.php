<?php

namespace App\Controllers;

use App\Models\Model_kwitansi;

class Kwitansi extends BaseController
{
    protected $Model_kwitansi;

    public function __construct()
    {
        helper(['form', 'url', 'terbilang']);
        $this->Model_kwitansi = new Model_kwitansi();
        // Proteksi halaman, hanya admin (level 1) yang bisa akses
        if (session()->get('level') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function index()
    {
        $data = [
            'title'     => 'Manajemen Kwitansi',
            'kwitansi'  => $this->Model_kwitansi->orderBy('id_kwitansi', 'DESC')->findAll(),
            'isi'       => 'kwitansi/v_index'
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        // Membuat nomor kwitansi otomatis
        $last_id = $this->Model_kwitansi->selectMax('id_kwitansi')->first();
        $next_id = ($last_id['id_kwitansi'] ?? 0) + 1;
        $no_kwitansi = 'KWI/' . date('Ymd') . '/' . sprintf('%04d', $next_id);

        $data = [
            'title' => 'Tambah Kwitansi',
            'no_kwitansi' => $no_kwitansi,
            'isi'   => 'kwitansi/v_add'
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        $uang_sejumlah = $this->request->getPost('uang_sejumlah');
        $data = [
            'no_kwitansi'         => $this->request->getPost('no_kwitansi'),
            'tanggal'             => $this->request->getPost('tanggal'),
            'telah_diterima_dari' => $this->request->getPost('telah_diterima_dari'),
            'uang_sejumlah'       => $uang_sejumlah,
            'untuk_keperluan'     => $this->request->getPost('untuk_keperluan'),
            'terbilang'           => ucwords(trim(terbilang($uang_sejumlah)) . ' Rupiah'),
        ];

        $this->Model_kwitansi->insert($data);
        session()->setFlashdata('pesan', 'Data Kwitansi Berhasil Ditambahkan.');
        return redirect()->to(base_url('kwitansi'));
    }

    public function edit($id_kwitansi)
    {
        $data = [
            'title'    => 'Edit Kwitansi',
            'kwitansi' => $this->Model_kwitansi->get_data($id_kwitansi),
            'isi'      => 'kwitansi/v_edit'
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_kwitansi)
    {
        $uang_sejumlah = $this->request->getPost('uang_sejumlah');
        $data = [
            'no_kwitansi'         => $this->request->getPost('no_kwitansi'),
            'tanggal'             => $this->request->getPost('tanggal'),
            'telah_diterima_dari' => $this->request->getPost('telah_diterima_dari'),
            'uang_sejumlah'       => $uang_sejumlah,
            'untuk_keperluan'     => $this->request->getPost('untuk_keperluan'),
            'terbilang'           => ucwords(trim(terbilang($uang_sejumlah)) . ' Rupiah'),
        ];

        $this->Model_kwitansi->update($id_kwitansi, $data);
        session()->setFlashdata('pesan', 'Data Kwitansi Berhasil Diperbarui.');
        return redirect()->to(base_url('kwitansi'));
    }

    public function delete($id_kwitansi)
    {
        $this->Model_kwitansi->delete($id_kwitansi);
        session()->setFlashdata('pesan', 'Data Kwitansi Berhasil Dihapus.');
        return redirect()->to(base_url('kwitansi'));
    }

    public function print($id_kwitansi)
    {
        $data = [
            'title'    => 'Cetak Kwitansi',
            'kwitansi' => $this->Model_kwitansi->get_data($id_kwitansi),
        ];
        return view('kwitansi/v_print', $data);
    }
}