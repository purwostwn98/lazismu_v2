<?php

namespace App\Controllers;

use App\Models\AjuanModel;
use App\Models\Berita_acaraModel;
use App\Models\IndividuModel;
use App\Models\PemohonModel;
use App\Models\ProvinsiModel;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\ProgramModel;
use App\Models\PilarModel;
use App\Models\KategoriModel;
use App\Models\SyaratModel;
use App\Models\KategoripenerimaModel;
use App\Models\MuzakiModel;
use App\Models\PekerjaanModel;
use App\Models\PenghasilanModel;
use App\Models\PenghimpunanModel;
use App\Models\PenghimpunanKtgModel;
use App\Models\PenghimpunanSubktgModel;

class Dynamic extends BaseController
{
    protected $penghimpunanModel;
    protected $penghimpunanKtgModel;
    protected $penghimpunanSubktgModel;
    protected $pekerjaanModel;
    protected $penghasilanModel;
    protected $pemohonModel;
    protected $provinsiModel;
    protected $kabupatenModel;
    protected $kecamatanModel;
    protected $kelurahanModel;
    protected $programModel;
    protected $pilarModel;
    protected $ktgprogramModel;
    protected $syaratModel;
    protected $berita_acaraModel;
    protected $ktgpenerimaModel;
    protected $ajuanModel;
    protected $individuModel;
    protected $muzakiModel;

    public function __construct()
    {
        $this->penghimpunanModel = new PenghimpunanModel();
        $this->penghimpunanKtgModel = new PenghimpunanKtgModel();
        $this->penghimpunanSubktgModel = new PenghimpunanSubktgModel();
        $this->muzakiModel = new MuzakiModel();
        $this->pekerjaanModel = new PekerjaanModel();
        $this->pemohonModel = new PemohonModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kabupatenModel = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->programModel = new ProgramModel();
        $this->pilarModel = new PilarModel();
        $this->ktgprogramModel = new KategoriModel();
        $this->syaratModel = new SyaratModel();
        $this->berita_acaraModel = new Berita_acaraModel();
        $this->ktgpenerimaModel = new KategoripenerimaModel();
        $this->ajuanModel = new AjuanModel();
        $this->individuModel = new IndividuModel();
        $this->penghasilanModel = new PenghasilanModel();
    }

    public function form_tindakan()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $jenis = $this->request->getVar('jenis');
            $data = [
                'jenis' => $jenis
            ];
            $msg = [
                'data' => view('admin/tambahan/form_tindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function cek_form_biodata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nik' => [
                    'label' => 'NIK',
                    'rules' => 'required|exact_length[16]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'exact_length' => '{field} harus 16 angka'
                    ]
                ]
            ]);
            if (!$valid) {
                $data = [
                    'pesan' => $validation->getError('nik'),
                    'biodata' => 404,
                    'provinsi' => $this->provinsiModel->findAll(),
                    'status' => 404
                ];
            } else {
                $nik = $this->request->getVar('nik');
                $biodata = $this->pemohonModel->where('nik', $nik)->first();
                if ($biodata) {
                    $pesan = "Biodata Anda sudah tersimpan, silahkan klik simpan dan melanjutkan ajuan!";
                    $biodata = $biodata;
                    $kabupaten = $this->kabupatenModel->where('id_provinsi', $biodata['id_provinsi'])->findAll();
                    $kecamatan = $this->kecamatanModel->where('id_kabupaten', $biodata['id_kabupaten'])->findAll();
                    $kelurahan = $this->kelurahanModel->where('id_kecamatan', $biodata['id_kecamatan'])->findAll();
                    $status = 0;
                } else {
                    $pesan = "Mohon lengkapi biodata di bawah ini!";
                    $biodata = 1;
                    $kabupaten = "";
                    $kecamatan = "";
                    $kelurahan = "";
                    $status = 1;
                }
                $data = [
                    'pesan' => $pesan,
                    'biodata' => $biodata,
                    'provinsi' => $this->provinsiModel->findAll(),
                    'kabupaten' => $kabupaten,
                    'kecamatan' => $kecamatan,
                    'kelurahan' => $kelurahan,
                    'status' => $status
                ];
            }
            $msg = [
                'data' => view('front/tambahan/form_biodata', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_kabupaten()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $id_provinsi = $this->request->getVar('id_provinsi');
            $kabupaten = $this->kabupatenModel->where('id_provinsi', $id_provinsi)->findAll();

            $data = [
                'kabupaten' => $kabupaten
            ];
            $msg = [
                'data' => view('front/tambahan/kabupaten', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_kecamatan()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $id_kabupaten = $this->request->getVar('id_kabupaten');
            $kecamatan = $this->kecamatanModel->where('id_kabupaten', $id_kabupaten)->findAll();

            $data = [
                'kecamatan' => $kecamatan
            ];
            $msg = [
                'data' => view('front/tambahan/kecamatan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_kelurahan()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $id_kecamatan = $this->request->getVar('id_kecamatan');
            $kelurahan = $this->kelurahanModel->where('id_kecamatan', $id_kecamatan)->findAll();

            $data = [
                'kelurahan' => $kelurahan
            ];
            $msg = [
                'data' => view('front/tambahan/kelurahan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function select_kategori()
    {
        if ($this->request->isAJAX()) {
            $id_pilar = $this->request->getVar('id_pilar');
            $kategori = $this->ktgprogramModel->where('id_pilar', $id_pilar)->where('status_kategori', 1)->findAll();

            $data = [
                'data_kategori' => $kategori
            ];
            $msg = [
                'data' => view('front/tambahan/select_kategori_program', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function select_program()
    {
        if ($this->request->isAJAX()) {
            $id_kategori = $this->request->getVar('id_kategori');
            $program = $this->programModel->where('id_kategori_program', $id_kategori)->findAll();

            $data = [
                'data_program' => $program
            ];
            $msg = [
                'data' => view('front/tambahan/select_program', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_syarat_program()
    {
        if ($this->request->isAJAX()) {
            $id_program = $this->request->getVar('id_program');
            $syarat = $this->syaratModel->where('id_program', $id_program)->findAll();

            $data = [
                'data_program' => $syarat,
                'program' => $this->programModel->where('id_program', $id_program)->first()
            ];
            $msg = [
                'data' => view('front/tambahan/syarat_program', $data),
                'data2' => view('front/tambahan/download_template_formulir', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_nama_delegasi()
    {
        if ($this->request->isAJAX()) {
            $jumlah = $this->request->getVar('jumlah');
            $data = [
                'jumlah' => $jumlah
            ];
            $msg = [
                'data' => view('admin/tambahan/form_surat_tugas', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_ket_penyerahan()
    {
        if ($this->request->isAJAX()) {
            $bentuk = $this->request->getVar('bentuk');
            $data = [
                'bentuk' => $bentuk,
            ];
            $msg = [
                'data' => view('admin/tambahan/ket_bentuk_penyerahan', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_kategori_penerima()
    {
        if ($this->request->isAJAX()) {
            $dana = $this->request->getVar('dana');
            $data = [
                'ktg_penerima' => $this->ktgpenerimaModel->where('id_dana_dari', $dana)->findAll(),
            ];
            $msg = [
                'data' => view('admin/tambahan/select_kategori_penerima', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function form_edit_ktg()
    {
        if ($this->request->isAJAX()) {
            $id_ktg = $this->request->getVar('id_ktg');
            $data = [
                'data_ktg' => $this->ktgprogramModel->where('id_kategori_program', $id_ktg)->first(),
            ];
            $msg = [
                'data' => view('admin/tambahan/edit_ktg', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function form_edit_program()
    {
        if ($this->request->isAJAX()) {
            $id_program = $this->request->getVar('id_program');
            $data = [
                'data_program' => $this->programModel->where('id_program', $id_program)->first(),
            ];
            $msg = [
                'data' => view('admin/tambahan/edit_program', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function form_edit_syarat()
    {
        if ($this->request->isAJAX()) {
            $id_syarat = $this->request->getVar('id_syarat');
            $data = [
                'data_syarat' => $this->syaratModel->where('id_syarat', $id_syarat)->first(),
            ];
            $msg = [
                'data' => view('admin/tambahan/edit_syarat', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    function load_modal_ctt_doc()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                'id' => $id,
                'jenis' => $this->request->getPost('jenis')
            ];
            $msg = [
                'data' => view('admin/tambahan/modal_catatan_doc', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_modal_deskripsi()
    {
        if ($this->request->isAJAX()) {
            $idajuan = $this->request->getVar('idajuan');
            $ajuan_row = $this->ajuanModel->where('id_ajuan', $idajuan)->first();
            $data = [
                'id_ajuan' => $idajuan,
                'ajuan_row' => $ajuan_row
            ];
            $msg = [
                'data' => view('admin/tambahan/modal_edit_deskripsi', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function cek_form_mustahik()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nik_mustahik' => [
                    'label' => 'NIK',
                    'rules' => 'required|exact_length[16]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'exact_length' => '{field} harus 16 angka'
                    ]
                ]
            ]);
            if (!$valid) {
                $data = [
                    'pesan' => $validation->getError('nik_mustahik'),
                    'biodata' => 404,
                    'provinsi' => $this->provinsiModel->findAll(),
                    'status' => 404
                ];
            } else {
                $nik = $this->request->getVar('nik_mustahik');
                $biodata = $this->individuModel->where('nik', $nik)->orderBy('updated_at', "DESC")->first();
                if (!empty($biodata)) {
                    $pesan = "Biodata Anda sudah pernah tersimpan,";
                    $biodata = $biodata;
                    $kabupaten = $this->kabupatenModel->where('id_provinsi', $biodata['provinsi'])->findAll();
                    $kecamatan = $this->kecamatanModel->where('id_kabupaten', $biodata['kabupaten'])->findAll();
                    $kelurahan = $this->kelurahanModel->where('id_kecamatan', $biodata['kecamatan'])->findAll();
                    $status = 0;
                } else {
                    $pesan = "Mohon lengkapi data di bawah ini!";
                    $biodata = 1;
                    $kabupaten = "";
                    $kecamatan = "";
                    $kelurahan = "";
                    $status = 1;
                }
                $data = [
                    'pesan' => $pesan,
                    'biodata' => $biodata,
                    'provinsi' => $this->provinsiModel->findAll(),
                    'kabupaten' => $kabupaten,
                    'kecamatan' => $kecamatan,
                    'kelurahan' => $kelurahan,
                    'pekerjaan' => $this->pekerjaanModel->findAll(),
                    'penghasilan' => $this->penghasilanModel->findAll(),
                    'status' => $status
                ];
            }
            $msg = [
                'data' => view('front/tambahan/form_mustahik', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_modal_mustahik()
    {
        if ($this->request->isAJAX()) {
            $nomor_ajuan = $this->request->getVar('nomor_ajuan');
            $data = [
                'nomor_ajuan' => $nomor_ajuan,
                'provinsi' => $this->provinsiModel->findAll(),
                'pekerjaan' => $this->pekerjaanModel->findAll(),
                'penghasilan' => $this->penghasilanModel->findAll(),
            ];
            $msg = [
                'data' => view('admin/tambahan/modal_add_mustahik', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_modal_edit_mustahik()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_individu');
            $biodata = $this->individuModel->where('id_individu', $id)->first();
            if (!empty($biodata)) {
                $pesan = "Biodata Anda sudah pernah tersimpan,";
                $biodata = $biodata;
                $kabupaten = $this->kabupatenModel->where('id_provinsi', $biodata['provinsi'])->findAll();
                $kecamatan = $this->kecamatanModel->where('id_kabupaten', $biodata['kabupaten'])->findAll();
                $kelurahan = $this->kelurahanModel->where('id_kecamatan', $biodata['kecamatan'])->findAll();
                $status = 0;
            } else {
                $pesan = "Mohon lengkapi data di bawah ini!";
                $biodata = 1;
                $kabupaten = "";
                $kecamatan = "";
                $kelurahan = "";
                $status = 1;
            }
            $data = [
                'pesan' => $pesan,
                'biodata' => $biodata,
                'provinsi' => $this->provinsiModel->findAll(),
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'pekerjaan' => $this->pekerjaanModel->findAll(),
                'penghasilan' => $this->penghasilanModel->findAll(),
                'status' => $status
            ];
            $msg = [
                'data' => view('admin/tambahan/modal_edit_mustahik', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_dt_muzaki()
    {
        if ($this->request->isAJAX()) {
            $email_muzaki = $this->request->getVar('email');
            $muzaki = $this->muzakiModel->where('email_muzaki', $email_muzaki)->first();
            $data = [
                'dt' => $muzaki
            ];
            $msg = [
                'data' => view('admin/penghimpunan/dinamis/dt_muzaki', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
    public function load_tabel_himpun()
    {
        if ($this->request->isAJAX()) {
            $bulan = $this->request->getVar('bulan');
            $tahun = $this->request->getVar('tahun');
            $dt = $this->penghimpunanModel
                ->where("MONTH(tanggal_himpun)", $bulan)
                ->where("YEAR(tanggal_himpun)", $tahun)
                ->join('dt_muzaki', 'tr_penghimpunan.email_muzaki = dt_muzaki.email_muzaki')
                ->join('dt_penghimpunan_subktg as subktg', 'tr_penghimpunan.sub_ktg_himpun = subktg.id_sub_ktg')
                ->join('dt_penghimpunan_ktg as ktg', 'tr_penghimpunan.ktg_himpun = ktg.id_ktg')
                ->findAll();
            $data = [
                'data' => $dt
            ];
            $msg = [
                'data' => view('admin/penghimpunan/dinamis/v_tabel_himpun', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_select_subktg_himpun()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                'dt' => $this->penghimpunanSubktgModel->where('id_ktg_himpun', $id)->findAll()
            ];
            $msg = [
                'data' => view('admin/penghimpunan/dinamis/sub_ktg_select', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
