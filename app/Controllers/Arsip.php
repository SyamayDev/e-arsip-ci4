<?php

namespace App\Controllers;

use App\Models\Model_arsip;
use App\Models\Model_kategori;
use App\Models\Model_dep;

class Arsip extends BaseController
{
	public function __construct()
	{
		$this->Model_kategori = new Model_kategori();
		$this->Model_arsip = new Model_arsip();
		$this->Model_dep = new Model_dep();
		helper('form');
	}

	public function index()
	{
		$id_user = session()->get('id_user');
		$level = session()->get('level');

		if ($level == 1) {
			$arsip = $this->Model_arsip->all_data();
		} else {
			$arsip = $this->Model_arsip->all_data_user($id_user);
		}

		$data = array(
			'title' => 'Arsip',
			'arsip' => $arsip,
			'isi' => 'arsip/v_index'
		);
		return view('layout/v_wrapper', $data);
	}

    public function by_month($month)
    {
        $nama_bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $data = [
            'title' => 'Arsip Bulan ' . ($nama_bulan[$month] ?? 'Tidak Valid'),
            'arsip' => $this->Model_arsip->get_arsip_by_month($month),
            'isi'   => 'arsip/v_arsip_grid'
        ];
        return view('layout/v_wrapper', $data);
    }

    public function by_department($id_dep)
    {
        $dep = $this->Model_dep->detail_data($id_dep);
        $nama_dep = $dep ? $dep['nama_dep'] : 'Tidak Ditemukan';

        $data = [
            'title' => 'Arsip Departemen ' . $nama_dep,
            'arsip' => $this->Model_arsip->get_arsip_by_department($id_dep),
            'isi'   => 'arsip/v_arsip_grid'
        ];
        return view('layout/v_wrapper', $data);
    }

	public function add(): string
	{
		$data = array(
			'title' => 'Tambah Arsip',
			'kategori' => $this->Model_kategori->all_data(), // Add kategori data
			'isi' => 'arsip/v_add'
		);
		return view('layout/v_wrapper', $data);
	}

	public function insert()
	{
		if ($this->validate([
			'nama_arsip' => [
				'label' => 'Nama Arsip',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi.',
				],
			],
			'deskripsi' => [
				'label' => 'Deskripsi',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi.',
				],
			],
			'id_kategori' => [
				'label' => 'Kategori',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi.',
				],
			],
			'file_arsip' => [
				'label' => 'File Arsip',
				'rules' => 'uploaded[file_arsip]|max_size[file_arsip,10024]|ext_in[file_arsip,pdf]',
				'errors' => [
					'uploaded' => '{field} harus diisi.',
					'max_size' => 'Ukuran {field} terlalu besar. Maksimal 10MB.',
					'ext_in' => 'Format {field} wajib .PDF',
				],
			],
		])) {
			$file_arsip = $this->request->getFile('file_arsip');
			$nama_file = $file_arsip->getRandomName();
			$ukuranfile = $file_arsip->getSize('kb');

			$data = [
				'id_kategori' => $this->request->getPost('id_kategori'),
				'no_arsip' => date('ymd') . '-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4),
				'nama_arsip' => $this->request->getPost('nama_arsip'),
				'deskripsi' => $this->request->getPost('deskripsi'),
				'tgl_upload' => date('Y-m-d'),
				'tgl_update' => date('Y-m-d'),
				'id_dep' => session()->get('id_dep'),
				'id_user' => session()->get('id_user'),
				'file_arsip' => $nama_file,
				'ukuran_file' => $ukuranfile,
                'tgl_mulai_aktif' => $this->request->getPost('tgl_mulai_aktif'),
                'tgl_selesai_aktif' => $this->request->getPost('tgl_selesai_aktif'),
			];

			$file_arsip->move('file_arsip', $nama_file);
			$this->Model_arsip->add($data);
			session()->setFlashdata('pesan', 'Data Berhasil Disimpan !!!');
			return redirect()->to(base_url('arsip'));
		} else {
			session()->setFlashdata('errors', $this->validator->getErrors());
			return redirect()->to(base_url('arsip/add'))->withInput();
		}
	}

	public function edit($id_arsip)
	{
		$arsip = $this->Model_arsip->detail_data($id_arsip);
        if (session()->get('level') == 2 && $arsip['id_user'] != session()->get('id_user')) {
            session()->setFlashdata('pesan', 'Anda tidak memiliki hak akses untuk data ini!');
            return redirect()->to(base_url('arsip'));
        }

		$data = array(
			'title' => 'Edit Arsip',
			'kategori' => $this->Model_kategori->all_data(),
			'arsip' => $arsip,
			'isi' => 'arsip/v_edit'
		);
		return view('layout/v_wrapper', $data);
	}

	public function update($id_arsip)
{
    $arsip = $this->Model_arsip->detail_data($id_arsip);
    if (session()->get('level') == 2 && $arsip['id_user'] != session()->get('id_user')) {
        session()->setFlashdata('pesan', 'Anda tidak memiliki hak akses untuk data ini!');
        return redirect()->to(base_url('arsip'));
    }

    if ($this->validate([
        'nama_arsip' => [
            'label' => 'Nama Arsip',
            'rules' => 'required',
            'errors' => ['required' => '{field} harus diisi.'],
        ],
        'deskripsi' => [
            'label' => 'Deskripsi',
            'rules' => 'required',
            'errors' => ['required' => '{field} harus diisi.'],
        ],
        'id_kategori' => [
            'label' => 'Kategori',
            'rules' => 'required',
            'errors' => ['required' => '{field} harus diisi.'],
        ],
        'file_arsip' => [
            'label' => 'File Arsip',
            'rules' => 'max_size[file_arsip,10024]|ext_in[file_arsip,pdf]',
            'errors' => [
                'max_size' => 'Ukuran {field} terlalu besar. Maksimal 10MB.',
                'ext_in' => 'Format {field} wajib .PDF',
            ],
        ],
    ])) {
        $file_arsip = $this->request->getFile('file_arsip');

        // data yang akan diupdate — TIDAK mengubah id_dep dan id_user
        $data = [
            'id_arsip'    => $id_arsip,
            'id_kategori' => $this->request->getPost('id_kategori'),
            'no_arsip'    => $this->request->getPost('no_arsip'),
            'nama_arsip'  => $this->request->getPost('nama_arsip'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'tgl_update'  => date('Y-m-d'),
            // <--- jangan masukkan 'id_dep' dan 'id_user' di sini
        ];

        // jika admin boleh ubah masa aktif
        if (session()->get('level') == 1) {
            $data['tgl_mulai_aktif'] = $this->request->getPost('tgl_mulai_aktif');
            $data['tgl_selesai_aktif'] = $this->request->getPost('tgl_selesai_aktif');
        }

        // jika ada file baru, replace file lama
        if ($file_arsip->getError() != 4) {
            // pastikan file lama ada sebelum unlink
            if (!empty($arsip['file_arsip']) && is_file('file_arsip/' . $arsip['file_arsip'])) {
                unlink('file_arsip/' . $arsip['file_arsip']);
            }
            $nama_file = $file_arsip->getRandomName();
            $ukuranfile = $file_arsip->getSize('kb');
            $data['file_arsip'] = $nama_file;
            $data['ukuran_file'] = $ukuranfile;
            $file_arsip->move('file_arsip', $nama_file);
        }

        $this->Model_arsip->edit($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !!!');
        return redirect()->to(base_url('arsip'));
    } else {
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to(base_url('arsip/edit/' . $id_arsip));
    }
}

	public function delete($id_arsip)
	{
		$arsip = $this->Model_arsip->detail_data($id_arsip);
        if (session()->get('level') == 2 && $arsip['id_user'] != session()->get('id_user')) {
            session()->setFlashdata('pesan', 'Anda tidak memiliki hak akses untuk data ini!');
            return redirect()->to(base_url('arsip'));
        }

		if ($arsip['file_arsip'] != "") {
			unlink('file_arsip/' . $arsip['file_arsip']);
		}

		$data = array(
			'id_arsip' => $id_arsip
		);

		$this->Model_arsip->delete_data($data);
		session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!!');
		return redirect()->to(base_url('arsip'));
	}

	public function view_pdf($id_arsip)
	{
	    $arsip = $this->Model_arsip->detail_data($id_arsip);

        // Cek Masa Aktif untuk User
        if (session()->get('level') == 2) {
            $today = date('Y-m-d');
            if ($arsip['tgl_selesai_aktif'] != null && $arsip['tgl_selesai_aktif'] < $today) {
                session()->setFlashdata('pesan', 'Arsip ini sudah melewati masa aktifnya dan tidak bisa diakses.');
                return redirect()->to(base_url('arsip'));
            }
        }

        if (session()->get('level') == 2 && $arsip['id_user'] != session()->get('id_user')) {
            session()->setFlashdata('pesan', 'Anda tidak memiliki hak akses untuk data ini!');
            return redirect()->to(base_url('arsip'));
        }

		$data = array(
			'title' => 'View Arsip',
			'arsip' => $arsip,
			'isi' => 'arsip/v_viewpdf'
		);
		return view('layout/v_wrapper', $data);
	}
}
