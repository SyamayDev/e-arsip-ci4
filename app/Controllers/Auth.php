<?php

namespace App\Controllers;

use App\Models\Model_auth;
use App\Models\Model_dep;
use App\Models\Model_user;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Model_auth = new Model_auth();
        $this->Model_user = new Model_user();
        $this->Model_dep = new Model_dep();
    }

    public function index()
    {
        $data = array(
            'title' => 'Login',
        );
        return view('v_login', $data);
    }

    public function register()
    {
        $data = array(
            'title' => 'Register',
            'dep' => $this->Model_dep->all_data(),
        );
        return view('v_register', $data);
    }

    public function save_register()
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama User',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ],
            ],
            'email' => [
                'label'  => 'E-Mail',
                'rules'  => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                    'is_unique' => '{field} Sudah Terdaftar, Gunakan Email Lain !!!',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ],
            ],
            'repassword' => [
                'label'  => 'Retype Password',
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                    'matches' => '{field} Tidak Sama Dengan Password !!!',
                ],
            ],
            'id_dep' => [
                'label'  => 'Departemen',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ],
            ],
        ])) {
            //jika valid
            $data = array(
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'id_dep' => $this->request->getPost('id_dep'),
                'level' => 2,
                'foto' => 'user.jpeg',
            );
            $this->Model_user->add($data);
            session()->setFlashdata('pesan', 'Register Berhasil, Silahkan Login !!!');
            return redirect()->to(base_url('auth'));
        } else {
            //jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/register'));
        }
    }

    public function login()
    {
        if ($this->validate([
            'email' => [
                'label'  => 'E-Mail',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ],
            ]
        ])) {
            // jika valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek = $this->Model_auth->login($email, $password);
            if ($cek) {
                // jika data cocok
                session()->set('log', true);
                session()->set('id_user', $cek['id_user']);
                session()->set('nama_user', $cek['nama_user']);
                session()->set('email', $cek['email']);
                session()->set('level', $cek['level']);
                session()->set('foto', $cek['foto']);
                session()->set('id_dep', $cek['id_dep']);
                // login berhasil
                if ($cek['level'] == 1) {
                    return redirect()->to(base_url('home'));
                } else {
                    return redirect()->to(base_url('arsip'));
                }
            } else {
                // jika data tidak cocok
                session()->setFlashdata('pesan', 'Login Gagal !!!, Username Atau Password Salah !!!');
                return redirect()->to(base_url('auth/index'));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/index'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('id_user');
        session()->remove('nama_user');
        session()->remove('email');
        session()->remove('level');
        session()->remove('foto');
        session()->remove('id_dep');

        session()->setFlashdata('pesan', 'Anda Telah Logout !!!');
        return redirect()->to(base_url('auth'));
    }
    //--------------------------------------------------------------------

}
