<?php

namespace App\Controllers;

use App\Models\Model_user;
use App\Models\Model_dep;

class Profile extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Model_user = new Model_user();
        $this->Model_dep = new Model_dep();
    }

    public function index()
    {
        $id_user = session()->get('id_user');
        $data = array(
            'title' => 'Edit Profile',
            'user' => $this->Model_user->detail_data($id_user),
            'dep' => $this->Model_dep->all_data(),
            'isi' => 'v_profile',
        );
        return view('layout/v_wrapper', $data);
    }

    public function update()
    {
        $id_user = session()->get('id_user');
        $user = $this->Model_user->detail_data($id_user);

        // Validation rules
        $rules = [
            'nama_user' => [
                'label'  => 'Nama User',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!'],
            ],
            'id_dep' => [
                'label'  => 'Departemen',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!'],
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,1024]|ext_in[foto,png,jpg,jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran {field} terlalu besar. Maksimal 1MB.',
                    'ext_in' => 'Format {field} wajib .png, .jpg, atau .jpeg',
                ],
            ],
        ];

        // Password validation
        $password = $this->request->getPost('password');
        if ($password) {
            $rules['old_password'] = [
                'label'  => 'Password Lama',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!'],
            ];
            $rules['password'] = [
                'label'  => 'Password Baru',
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                    'min_length' => '{field} minimal 4 karakter.',
                ],
            ];
        }

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('profile'));
        }

        // Check old password if new password is set
        if ($password) {
            $old_password = $this->request->getPost('old_password');
            if ($old_password != $user['password']) {
                session()->setFlashdata('errors', ['old_password' => 'Password Lama Salah !!!']);
                return redirect()->to(base_url('profile'));
            }
        }

        // Handle file upload
        $foto_file = $this->request->getFile('foto');
        if ($foto_file->getError() == 4) {
            $nama_file = $user['foto'];
        } else {
            $file_path = 'foto/' . $user['foto'];
            if ($user['foto'] != '' && $user['foto'] != 'user.jpeg' && file_exists($file_path)) {
                unlink($file_path);
            }
            $nama_file = $foto_file->getRandomName();
            $foto_file->move('foto', $nama_file);
        }

        $data = [
            'id_user'   => $id_user,
            'nama_user' => $this->request->getPost('nama_user'),
            'id_dep'    => $this->request->getPost('id_dep'),
            'foto'      => $nama_file,
        ];

        if ($password) {
            $data['password'] = $password;
        }

        $this->Model_user->edit($data);

        // Update session data
        session()->set('nama_user', $data['nama_user']);
        session()->set('foto', $data['foto']);

        session()->setFlashdata('pesan', 'Profil Berhasil Diperbarui !!!');
        return redirect()->to(base_url('profile'));
    }
}
