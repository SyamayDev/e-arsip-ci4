<?php

namespace App\Controllers;

use App\Models\Model_arsip;
use App\Models\Model_kategori;

class Arsip extends BaseController
{
	public function __construct()
	{
		$this->Model_kategori = new Model_kategori();
		$this->Model_arsip = new Model_arsip();
		helper('form');
	}

	public function index()
	{
		$data = array(
			'title' => 'Arsip',
			'arsip' => $this->Model_arsip->all_data(),
			'kategori' => $this->Model_kategori->all_data(),
			'recent_arsip' => $this->Model_arsip->all_data(),
			'isi' => 'arsip/v_index'
		);
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
				'rules' => 'required', // Removed incorrect is_unique rule
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
					'max_size' => 'Ukuran {field} terlalu besar. Maksimal 5MB.',
					'ext_in' => 'Format {field} wajib .PDF',
				],
			],
		])) {
			$file_arsip = $this->request->getFile('file_arsip');
			$nama_file = $file_arsip->getRandomName(); // Fixed variable name
			// mengambil ukuran file
			$ukuranfile = $file_arsip->getSize('kb');

			$data = [
				'id_kategori' => $this->request->getPost('id_kategori'),
				'no_arsip' => $this->request->getPost('no_arsip'),
				'nama_arsip' => $this->request->getPost('nama_arsip'),
				'deskripsi' => $this->request->getPost('deskripsi'),
				'tgl_upload' => date('Y-m-d'),
				'tgl_update' => date('Y-m-d'),
				'id_dep' => session()->get('id_dep'),
				'id_user' => session()->get('id_user'),
				'file_arsip' => $nama_file,
				'ukuran_file' => $ukuranfile,
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
		$data = array(
			'title' => 'Edit Arsip',
			'kategori' => $this->Model_kategori->all_data(),
			'arsip' => $this->Model_arsip->detail_data($id_arsip),
			'isi' => 'arsip/v_edit'
		);
		return view('layout/v_wrapper', $data);
	}

	public function update($id_arsip)
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
				'rules' => 'required', // Removed incorrect is_unique rule
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
				'rules' => 'max_size[file_arsip,10024]|ext_in[file_arsip,pdf]',
				'errors' => [
					'uploaded' => '{field} harus diisi.',
					'max_size' => 'Ukuran {field} terlalu besar. Maksimal 5MB.',
					'ext_in' => 'Format {field} wajib .PDF',
				],
			],
		])) {
			$file_arsip = $this->request->getFile('file_arsip');
			if ($file_arsip->getError() == 4) {
				$data = [
					'id_arsip' => $id_arsip,
					'id_kategori' => $this->request->getPost('id_kategori'),
					'no_arsip' => $this->request->getPost('no_arsip'),
					'nama_arsip' => $this->request->getPost('nama_arsip'),
					'deskripsi' => $this->request->getPost('deskripsi'),
					'tgl_update' => date('Y-m-d'),
					'id_dep' => session()->get('id_dep'),
					'id_user' => session()->get('id_user'),
				];
				$this->Model_arsip->edit($data);
			} else {
				$arsip = $this->Model_arsip->detail_data($id_arsip);
				if ($arsip['file_arsip'] != "") {
					unlink('file_arsip/' . $arsip['file_arsip']);
				}
				$nama_file = $file_arsip->getRandomName(); // Fixed variable name
				// mengambil ukuran file
				$ukuranfile = $file_arsip->getSize('kb');

				$data = [
					'id_arsip' => $id_arsip,
					'id_kategori' => $this->request->getPost('id_kategori'),
					'no_arsip' => $this->request->getPost('no_arsip'),
					'nama_arsip' => $this->request->getPost('nama_arsip'),
					'deskripsi' => $this->request->getPost('deskripsi'),
					'tgl_update' => date('Y-m-d'),
					'id_dep' => session()->get('id_dep'),
					'id_user' => session()->get('id_user'),
					'file_arsip' => $nama_file,
					'ukuran_file' => $ukuranfile,
				];

				$file_arsip->move('file_arsip', $nama_file);
				$this->Model_arsip->edit($data);
			}
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

		if ($arsip['file_arsip'] != "") {
			unlink('file_arsip/' . $arsip['file_arsip']);
		}

		$data = array(
			'id_arsip' => $id_arsip
		);

		$this->Model_arsip->delete_data($data);
		session()->setFlashdata('pesan', ' Berhasil Berhasil Dihapus !!!');
		return redirect()->to(base_url('arsip'));
	}

	public function view_pdf($id_arsip)
	{
		$data = array(
			'title' => 'View Arsip',
			'arsip' => $this->Model_arsip->detail_data($id_arsip),
			'isi' => 'arsip/v_viewpdf'
		);
		return view('layout/v_wrapper', $data);
	}

	
}
