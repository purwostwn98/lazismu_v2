<?php

namespace App\Controllers;

use App\Models\PemohonModel;
use App\Models\UsersModel;

class Iniauth extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $a = random_int(1, 9);
        $b = random_int(1, 9);
        $operator = "x+";
        $opr = substr($operator, mt_rand(0, strlen($operator) - 1), 1);
        $angka = array(
            1 =>   'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan'
        );

        if ($opr == 'x') {
            $hasil = $a * $b;
            $text_opr = 'dikali';
        } elseif ($opr == '+') {
            $hasil = $a + $b;
            $text_opr = 'ditambah';
        }
        $text = 'Berapa ' . $angka[$a] . ' ' . $text_opr . ' ' . $angka[$b] . '?';

        // Alert for edit user
        if ($this->session->getFlashdata('berhasil')) {
            $alert = $this->session->getFlashdata('berhasil');
            $jenisAlert = 'berhasil';
            $this->session->destroy();
        } elseif ($this->session->getFlashdata('gagal')) {
            $alert = $this->session->getFlashdata('gagal');
            $jenisAlert = 'gagal';
            $this->session->destroy();
        } else {
            $alert = false;
            $jenisAlert = 'none';
        }

        $data = [
            'text' => $text,
            'hasil' => $hasil,
            'alert' => $alert,
            'jenisAlert' => $jenisAlert
        ];
        return view('login/halaman_login', $data);
    }

    public function filter_masuk()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $hslbenar = $this->request->getVar('hslbenar');
        $jawaban = $this->request->getVar('jawabCpt');
        if (sha1($jawaban) == $hslbenar) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],

                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);
            if (!$valid) {
                $this->session->setFlashdata('errorUser', $validation->getError('username'));
                $this->session->setFlashdata('errorPassword', $validation->getError('password'));
                return redirect()->to('/iniauth/index')->withInput();
                // return redirect()->to('/people/edit/' . $this->request->getVar('slug'))->withInput()
            } else {
                // dd($username);
                $result = $this->userModel->where('username', $username)->first();
                if ($result) {
                    $pass = $result['password'];
                    if (sha1($password) == $pass) {
                        $dapat_session = [
                            'login' => true,
                            'iduser' => $result['iduser'],
                            'priv_user' => $result['privuser'],
                            'idlembaga' => $result['idlembaga'],
                            'nama' => $result['nama_user'],
                            'halaman' => 'admin'
                        ];
                        $this->session->set($dapat_session);
                        // if (($this->session->get('priv_user') == 1) || ($this->session->get('priv_user') == 3)) {
                        //     return redirect()->to('/admin/index');
                        // } elseif (($this->session->get('priv_user') == 1) || ($this->session->get('priv_user') == 2)) {
                        //     return redirect()->to('/bumd/index');
                        // } elseif ($this->session->get('priv_user') == 100) {
                        //     return redirect()->to('/superadmin/index');
                        // }
                        if ($this->session->get('priv_user') == 1) {
                            return redirect()->to('/admin/index');
                        } else {
                            return redirect()->to('/iniauth/index');
                        }
                    } else {
                        $this->session->setFlashdata('errorPassword', 'maaf, password yang Anda masukkan salah...');
                        return redirect()->to('/iniauth/index')->withInput();
                    }
                } else {
                    $this->session->setFlashdata('errorUser', 'maaf, username tidak ditemukan...');
                    return redirect()->to('/iniauth/index')->withInput();
                }
            }
        } else {
            $this->session->setFlashdata('errorHitung', 'maaf, hasil perhitungan Anda salah...');
            return redirect()->to('/iniauth/index')->withInput();
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/front/index');
    }

    //--------------------------------------------------------------------

}
