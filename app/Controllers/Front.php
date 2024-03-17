<?php

namespace App\Controllers;

use App\Models\PemohonModel;
use App\Models\ProvinsiModel;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\ProgramModel;
use App\Models\PilarModel;
use App\Models\KategoriModel;
use App\Models\SyaratModel;

class Front extends BaseController
{
    protected $pemohonModel;
    protected $provinsiModel;
    protected $kabupatenModel;
    protected $kecamatanModel;
    protected $kelurahanModel;
    protected $programModel;
    protected $pilarModel;
    protected $kategoriModel;
    protected $syaratModel;

    public function __construct()
    {
        $this->pemohonModel = new PemohonModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kabupatenModel = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->programModel = new ProgramModel();
        $this->pilarModel = new PilarModel();
        $this->kategoriModel = new KategoriModel();
        $this->syaratModel = new SyaratModel();
    }

    public function index()
    {
        return view('front/landing-page-1');
    }

    public function program($id_pilar)
    {
        $data_pilar = $this->pilarModel->where('id_pilar', $id_pilar)->first();
        $data_kategori = $this->kategoriModel->where('id_pilar', $id_pilar)->findAll();
        $list_program = [];
        foreach ($data_kategori as $key => $ktg) {
            $data_program = $this->programModel->where('id_kategori_program', $ktg['id_kategori_program'])->findAll();
            $list_syarat = [];
            foreach ($data_program as $key => $prg) {
                $data_syarat = $this->syaratModel->where('id_program', $prg['id_program'])->findAll();
                $list_syarat[] = $data_syarat;
            }
            $list_program[] = [$ktg['nama_kategori'], $ktg['deskripsi_kategori'], $ktg['status_kategori'], $data_program, $list_syarat];
        }
        $data = [
            'pilar' => $data_pilar,
            'list_program' => $list_program
        ];

        return view('front/program', $data);
    }

    public function formulir_biodata()
    {
        return view('front/formulir_biodata');
    }

    public function formulir_ajuan()
    {
        $nik = $this->encrypter->decrypt(hex2bin($this->request->getVar('hub')));
        // $nik = $this->request->getVar('nik');
        $cek_pemohon = $this->pemohonModel->where('nik', $nik)->first();
        if (!empty($cek_pemohon)) {
            $data = [
                'pemohon' => $cek_pemohon,
                'data_pilar' => $this->pilarModel->findAll(),
                'provinsi' => $this->provinsiModel->findAll(),
            ];
            return view('front/formulir_ajuan', $data);
        } else {
            return view('front/formulir_biodata');
        }
    }

    public function formulir_cekajuan()
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
        $data = [
            'text' => $text,
            'hasil' => $hasil,
        ];
        return view('front/formulir_cek-ajuan', $data);
    }
}
