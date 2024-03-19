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
use App\Models\FormB3Model;
use App\Models\BentukpenyerahanModel;
use App\Models\LembagaModel;
use App\Models\LogajuanModel;
use App\Models\NotulensiModel;
use App\Models\NotulensiAgendaModel;
use App\Models\NotulensiAjuanModel;
use CodeIgniter\I18n\Time;

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
    protected $formB3Model;
    protected $bentukbantuanModel;
    protected $kategori_penerimaModel;
    protected $notulensiModel;
    protected $notulensiAjuanModel;
    protected $notulensiAgendaModel;
    protected $lembagaModel;
    protected $logAjuanModel;

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
        $this->formB3Model = new FormB3Model();
        $this->bentukbantuanModel = new BentukpenyerahanModel();
        $this->kategori_penerimaModel = new KategoripenerimaModel();
        $this->notulensiModel = new NotulensiModel();
        $this->notulensiAjuanModel = new NotulensiAjuanModel();
        $this->notulensiAgendaModel = new NotulensiAgendaModel();
        $this->lembagaModel = new LembagaModel();
        $this->logAjuanModel = new LogajuanModel();
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

    public function load_modal_b3()
    {
        if ($this->request->isAJAX()) {
            $noajuan = $this->request->getVar('noajuan');
            $cek_data = $this->formB3Model->where('nomor_ajuan', $noajuan)->first();

            if (!empty($cek_data)) {
                $data = $cek_data;
                $asnaf = $this->kategori_penerimaModel->where('id_dana_dari', $cek_data['dana_dari'])->findAll();
            } else {
                $data = null;
                $asnaf = [];
            }

            $data =  [
                'data' => $cek_data,
                'no_ajuan' => $noajuan,
                'asnaf' => $asnaf,
                'bentuk_bantuan' => $this->bentukbantuanModel->findAll(),
            ];
            $msg = [
                'data' => view('admin/tambahan/modal_form_b3', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_sel_bentuk_penyerahan()
    {
        if ($this->request->isAJAX()) {
            $sumber = $this->request->getVar('sumber');
            $cek_data = $this->kategori_penerimaModel->where('id_dana_dari', $sumber)->findAll();
            $opt = '<option value="" selected disabled>Pilih Asnaf</option>';
            foreach ($cek_data as $key => $v) {
                $opt .= '<option value="' . $v['id_kategori_penerima'] . '">' . $v['ket_kategori_penerima'] . '</option>';
            }
            $msg = [
                'opt' => $opt,
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_tr_ajuan_notulensi()
    {
        if ($this->request->isAJAX()) {
            $idnotulensi = $this->request->getPost('idnotulensi');
            $notulensi_ajuan = $this->notulensiAjuanModel->where('idnotulensi', $idnotulensi)
                ->join('tr_ajuan', 'tr_notulensi_ajuan.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->join('dt_status_ajuan as sts', 'tr_ajuan.status_ajuan = sts.id_status')
                ->findAll();
            $tr = "";
            if (!empty($notulensi_ajuan)) {
                foreach ($notulensi_ajuan as $key => $v) {
                    $mustahik = "belum diisi";
                    if ($v['jenis_ajuan'] == "Lembaga") {
                        $lembaga = $this->lembagaModel->where('nomor_ajuan', $v['nomor_ajuan'])->first();
                        $mustahik = $lembaga['nama_lembaga'];
                    } elseif ($v['jenis_ajuan'] == "Individu") {
                        $individu = $this->individuModel->where('nomor_ajuan', $v['nomor_ajuan'])->first();
                        if (!empty($individu)) {
                            $mustahik = $individu['nama_mustahik'];
                        }
                    }

                    $b3 = $this->formB3Model->where('nomor_ajuan', $v['nomor_ajuan'])
                        ->join('dt_kategori_penerima', 'tr_form_b3.kategori_penerima = dt_kategori_penerima.id_kategori_penerima')
                        ->join('dt_bentuk_penyerahan', 'tr_form_b3.bentuk_penyerahan = dt_bentuk_penyerahan.id_bentuk_penyerahan')
                        ->first();
                    if (!empty($b3)) {
                        $sumber_dana = $b3['dana_dari'];
                        $asnaf = $b3['ket_kategori_penerima'];
                        $bentuk_penyerahan = $b3['ket_bentuk_penyerahan'];
                    } else {
                        $sumber_dana = "-";
                        $asnaf = "-";
                        $bentuk_penyerahan = "-";
                    }
                    $ambil_ket_log = $this->logAjuanModel->where(['nomor_ajuan' => $v['nomor_ajuan'], 'status_ajuan' => $v['status_ajuan']])->orderBy('tanggal_log', 'DESC')->first();
                    $time = Time::parse($v['tgl_diajukan']);
                    $tgl_diajukan = $time->toLocalizedString('d MMM yyyy');
                    $tr .= '<tr>
                                <td class="text-center"><a href="/admin/tindakan/' . $v['nik'] . '/' . $v['nomor_ajuan'] . '">' . $v['nomor_ajuan'] . '</a></td>
                                <td>' . $tgl_diajukan . '</td>
                                <td>' . $mustahik . '</td>
                                <td class="text-center">' . $v['keterangan_status'] . '</td>
                                <td>' . $v['nilai_disetujui'] . '</td>
                                <td class="text-center">' . $sumber_dana . '</td>
                                <td class="text-center">' . $asnaf . '</td>
                                <td>' . $bentuk_penyerahan . '</td>
                                <td>' . $ambil_ket_log['catatan_log'] . '</td>
                            </tr>';
                }
            } else {
                $tr = "<tr><td colspan='8'>Belum ada data ajuan</td></tr>";
            }
            $msg = [
                'tr' => $tr,
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_tr_cari_ajuan()
    {
        if ($this->request->isAJAX()) {
            $nomor_ajuan = $this->request->getPost('nomor_ajuan');
            $ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)
                ->join('ad_program', 'tr_ajuan.id_program = ad_program.id_program')
                ->join('tr_pemohon', 'tr_ajuan.nik = tr_pemohon.nik')
                ->findAll();
            $tr = "";
            foreach ($ajuan as $key => $v) {
                $time = Time::parse($v['tgl_diajukan']);
                $tgl_diajukan = $time->toLocalizedString('d MMM yyyy');
                $tr .= '<tr>
                                    <td class="text-center">' . $v['nomor_ajuan'] . '</td>
                                    <td>' . $tgl_diajukan . '</td>
                                    <td>' . $v['nama_pemohon'] . '</td>
                                    <td>' . $v['nama_program'] . '</td>
                                    <td class="text-center py-2"><button class="btn btn-sm btn-primary" type="button" id="pilih_' . $v['nomor_ajuan'] . '" value="' . $v['nomor_ajuan'] . '" onclick="PilihAjuan(this.value)">Pilih</button></td>
                        </tr>';
            }
            $msg = [
                'tr' => $tr,
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function do_pilih_ajuan_notulensi()
    {
        if ($this->request->isAJAX()) {
            $nomor_ajuan = $this->request->getPost('nomor_ajuan');
            $idnotulensi = $this->request->getPost('idnotulensi');
            $simpan = $this->notulensiAjuanModel->simpan($idnotulensi, $nomor_ajuan);
            if ($simpan == false) {
                $status = false;
            } else {
                $status = true;
            }
            $msg = [
                'status' => $status,
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function load_modal_edit_agenda_notulensi()
    {
        if ($this->request->isAJAX()) {
            $idagenda = $this->request->getPost('idagenda');
            $r = $this->notulensiAgendaModel->where('id', $idagenda)->first();
            $data = [
                'r_agenda' => $r
            ];
            $msg = [
                'modal'  => view('admin/tambahan/modal_edit_agenda_notulensi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
