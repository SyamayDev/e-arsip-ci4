<?php

namespace App\Controllers;

use App\Models\Model_user;
use App\Models\Model_dep;

class User extends BaseController
{
    public function __construct()
    {
        $this->Model_user = new Model_user();
        $this->Model_dep  = new Model_dep();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user'  => $this->Model_user->all_data(),
            'isi'   => 'user/v_index'
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add User',
            'dep'   => $this->Model_dep->all_data(),
            'isi'   => 'user/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required'  => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar. Gunakan {field} lain.',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required'   => '{field} harus diisi.',
                    'min_length' => '{field} harus minimal 5 karakter.',
                ],
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ],
            ],
            'id_dep' => [
                'label' => 'Departemen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ],
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|max_size[foto,5024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} harus diisi.',
                    'max_size' => 'Ukuran {field} terlalu besar. Maksimal 5MB.',
                    'mime_in'  => 'Format {field} wajib PNG, JPEG, JPG.',
                ],
            ],
        ])) {
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();

            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email'     => $this->request->getPost('email'),
                'password'  => $this->request->getPost('password'), // tanpa hash
                'level'     => $this->request->getPost('level'),
                'id_dep'    => $this->request->getPost('id_dep'),
                'foto'      => $nama_file,
            ];

            $foto->move('foto', $nama_file);
            $this->Model_user->add($data);
            session()->setFlashdata('pesan', 'Data Berhasil Disimpan !!!');
            return redirect()->to(base_url('user'));
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('user/add'))->withInput();
        }
    }

    public function edit($id_user)
    {
        $data = [
            'title' => 'Edit User',
            'user'  => $this->Model_user->detail_data($id_user),
            'dep'   => $this->Model_dep->all_data(),
            'isi'   => 'user/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_user)
    {
        $userLama = $this->Model_user->detail_data($id_user);

        $validationRules = [
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'permit_empty|min_length[5]',
                'errors' => [
                    'min_length' => '{field} harus minimal 5 karakter.',
                ],
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ],
            ],
            'id_dep' => [
                'label' => 'Departemen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ],
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,5024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} terlalu besar. Maksimal 5MB.',
                    'mime_in'  => 'Format {field} wajib PNG, JPEG, JPG.',
                ],
            ],
        ];

        if ($this->validate($validationRules)) {
            $foto = $this->request->getFile('foto');
            $data = [
                'id_user'   => $id_user,
                'nama_user' => $this->request->getPost('nama_user'),
                'level'     => $this->request->getPost('level'),
                'id_dep'    => $this->request->getPost('id_dep'),
            ];

            // update password kalau diisi
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['password'] = $password; // tanpa hash
            }

            // upload foto baru
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $nama_file = $foto->getRandomName();
                $foto->move('foto', $nama_file);
                $data['foto'] = $nama_file;

                // hapus foto lama
                if (!empty($userLama['foto']) && file_exists('foto/' . $userLama['foto'])) {
                    unlink('foto/' . $userLama['foto']);
                }
            }

            $this->Model_user->edit($data);
            session()->setFlashdata('pesan', 'Data Berhasil Diubah !!!');
            return redirect()->to(base_url('user'));
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('user/edit/' . $id_user))->withInput();
        }
    }

    public function delete($id_user)
    {
        $user = $this->Model_user->detail_data($id_user);

        if (!empty($user['foto']) && file_exists('foto/' . $user['foto'])) {
            unlink('foto/' . $user['foto']);
        }

        $this->Model_user->delete_data(['id_user' => $id_user]);

        session()->setFlashdata('pesan', 'User ' . esc($user['nama_user']) . ' Berhasil Dihapus !!!');
        return redirect()->to(base_url('user'));
    }
}