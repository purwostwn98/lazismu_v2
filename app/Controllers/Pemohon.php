<?php

namespace App\Controllers;

use App\Models\AjuanModel;
use App\Models\PemohonModel;
use App\Models\ProvinsiModel;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\LembagaModel;
use App\Models\StsajuanModel;
use App\Models\LogajuanModel;
use App\Models\Surat_tugasModel;
use App\Models\DelegasiModel;
use App\Models\Berita_acaraModel;
use App\Models\BentukpenyerahanModel;
use App\Models\DokumentasiModel;
use App\Models\IndividuModel;
use App\Models\ProgramModel;
use App\Models\PilarModel;
use App\Models\KategoriModel;
use App\Models\KuitansiModel;
use App\Models\SyaratModel;
use CodeIgniter\I18n\Time;
use TCPDF;

class Pemohon extends BaseController
{

    protected $pemohonModel;
    protected $provinsiModel;
    protected $kabupatenModel;
    protected $kecamatanModel;
    protected $kelurahanModel;
    protected $ajuanModel;
    protected $lembagaModel;
    protected $status_ajuanModel;
    protected $logajuanModel;
    protected $surat_tugasModel;
    protected $delegasiModel;
    protected $berita_acaraModel;
    protected $bentukbantuanModel;
    protected $programModel;
    protected $pilarModel;
    protected $kategoriModel;
    protected $syaratModel;
    protected $dokumentasiModel;
    protected $kuitansiModel;
    protected $individuModel;

    public function __construct()
    {
        $this->pemohonModel = new PemohonModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kabupatenModel = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->ajuanModel = new AjuanModel();
        $this->lembagaModel = new LembagaModel();
        $this->status_ajuanModel = new StsajuanModel();
        $this->logajuanModel = new LogajuanModel();
        $this->surat_tugasModel = new Surat_tugasModel();
        $this->delegasiModel = new DelegasiModel();
        $this->berita_acaraModel = new Berita_acaraModel();
        $this->bentukbantuanModel = new BentukpenyerahanModel();
        $this->programModel = new ProgramModel();
        $this->pilarModel = new PilarModel();
        $this->kategoriModel = new KategoriModel();
        $this->syaratModel = new SyaratModel();
        $this->dokumentasiModel = new DokumentasiModel();
        $this->kuitansiModel = new KuitansiModel();
        $this->individuModel = new IndividuModel();
    }

    public function index()
    {
        $ajuan = $this->ajuanModel->where('nomor_ajuan', $this->session->get('nomor_ajuan'))
            ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
            ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
            ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
            ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
            ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
            ->first();
        $data = [
            'halaman' => 'biodata_pemohon',
            'ajuan' => $ajuan
        ];
        return view('pemohon/dashboard_pemohon', $data);
    }

    public function riwayat_ajuan()
    {
        $ajuan = $this->ajuanModel->where('tr_ajuan.nik', $this->session->get('nik'))
            ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
            ->join('ad_program as prg', 'prg.id_program = tr_ajuan.id_program')
            ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
            ->findAll();
        $data = [
            'halaman' => 'riwayat_ajuan',
            'data_ajuan' => $ajuan
        ];
        return view('pemohon/riwayat_ajuan', $data);
    }

    public function detail_ajuan()
    {
        $nomor_ajuan = $this->session->get('nomor_ajuan');
        $nik = $this->session->get('nik');

        $cek_ajuan = $this->ajuanModel->where('nik', $nik)->where('nomor_ajuan', $nomor_ajuan)->first();

        if ($cek_ajuan['jenis_ajuan'] == 'Lembaga') {
            $ajuan = $this->ajuanModel->where('tr_ajuan.nik', $nik)->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                ->join('ad_kategori_program as ktg', 'ktg.id_kategori_program = tr_ajuan.id_kategori_program')
                ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                ->first();
        } else {
            $ajuan = $this->ajuanModel->where('tr_ajuan.nik', $nik)->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                ->join('ad_kategori_program as ktg', 'ktg.id_kategori_program = tr_ajuan.id_kategori_program')
                ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                ->first();
        }

        $log_ajuan = $this->logajuanModel->where('nomor_ajuan', $nomor_ajuan)
            ->join('dt_status_ajuan as sts', 'sts.id_status = ad_log_ajuan.status_ajuan')->findAll();

        foreach ($log_ajuan as $key => $log) {
            $time = Time::parse($log['tanggal_log']);
            $agenda = [$time->getMonth(), $time->getWeekOfMonth()];
            $array_log[] = [$log['keterangan_status'], $log['tanggal_log'], $log['catatan_log'], $log['log_created_by'], $agenda, $log['status_ajuan']];
        }
        // dd($array_log);
        $data = [
            'halaman' => 'halaman_ajuan',
            'ajuan' => $ajuan,
            'status_ajuan' => $this->status_ajuanModel->where('id_status !=', 1)->findAll(),
            'array_log' => $array_log,
            'surat_tugas' => $this->surat_tugasModel->where('nomor_ajuan', $nomor_ajuan)->findAll(),
            'berita_acara' => $this->berita_acaraModel->where('nomor_ajuan', $nomor_ajuan)->findAll(),
            'bentuk_bantuan' => $this->bentukbantuanModel->findAll()
        ];
        return view('pemohon/detail_ajuan', $data);
    }

    public function simpan_biodata_pemohon()
    {
        if ($this->request->isAJAX()) {
            $nik = $this->request->getVar('nik');
            if ($this->request->getVar('status') == 0) {
                $msg = [
                    'terdaftar' => [
                        'link_form_ajuan' => "/front/formulir_ajuan?hub=" . bin2hex($this->encrypter->encrypt($nik)),
                    ]
                ];
            } else {
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'nik' => [
                        'label' => 'nik',
                        'rules' => 'required|is_unique[tr_pemohon.nik]|exact_length[16]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => 'Maaf, {field} sudah terdaftar',
                            'exact_length' => '{field} harus 16 angka'
                        ]
                    ],
                    'nama_pemohon' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'jenis_kelamin' => [
                        'label' => 'Jenis kelamin',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'tempat_lahir' => [
                        'label' => 'Tempat lahir',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'tanggal_lahir' => [
                        'label' => 'Tanggal lahir',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'provinsi' => [
                        'label' => 'Provinsi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'kabupaten' => [
                        'label' => 'Kabupaten',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'kecamatan' => [
                        'label' => 'Kecamatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'kelurahan' => [
                        'label' => 'Kelurahan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'alamat_detail' => [
                        'label' => 'Alamat detail',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'agama' => [
                        'label' => 'Agama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'telepon' => [
                        'label' => 'Nomor telepon',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'email' => [
                        'label' => 'Email',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                ]);

                if (!$valid) {
                    $msg = [
                        'error' => [
                            'nik' => $validation->getError('nik'),
                            'nama_pemohon' => $validation->getError('nama_pemohon'),
                            'jenis_kelamin' => $validation->getError('jenis_kelamin'),
                            'tempat_lahir' => $validation->getError('tempat_lahir'),
                            'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                            'provinsi' => $validation->getError('provinsi'),
                            'kabupaten' => $validation->getError('kabupaten'),
                            'kecamatan' => $validation->getError('kecamatan'),
                            'kelurahan' => $validation->getError('kelurahan'),
                            'alamat_detail' => $validation->getError('alamat_detail'),
                            'agama' => $validation->getError('agama'),
                            'telepon' => $validation->getError('telepon'),
                            'email' => $validation->getError('email'),
                            'token' => csrf_hash(),
                        ]
                    ];
                } else {
                    $data = [
                        'nik' => $this->request->getVar('nik'),
                        'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                        'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                        'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                        'id_provinsi' => $this->request->getVar('provinsi'),
                        'id_kabupaten' => $this->request->getVar('kabupaten'),
                        'id_kecamatan' => $this->request->getVar('kecamatan'),
                        'id_kelurahan' => $this->request->getVar('kelurahan'),
                        'alamat_detail' => $this->request->getVar('alamat_detail'),
                        'agama' => $this->request->getVar('agama'),
                        'telepon' => $this->request->getVar('telepon'),
                        'email' => $this->request->getVar('email'),
                    ];
                    $this->pemohonModel->transBegin();
                    $this->pemohonModel->insert($data);
                    if ($this->pemohonModel->transStatus() === false) {
                        $this->pemohonModel->transRollback();
                        $msg = [
                            'gagal' => [
                                'pesan' => 'Data tidak dapat disimpan'
                            ]
                        ];
                    } else {
                        $this->pemohonModel->transCommit();
                        $msg = [
                            'berhasil' => [
                                'pesan' => 'Biodata Anda berhasil disimpan. Silakan melanjutkan untuk mengisi formulir ajuan!',
                                'link' => "/front/formulir_ajuan?nik=" . $nik
                            ]
                        ];
                    }
                }
            }
            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function simpan_ajuan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            // Jika jenis ajuan individu
            if ($this->request->getVar('jenis_bantuan') == 'Individu') {
                $valid = [
                    'jenis_bantuan' => [
                        'label' => 'Jenis bantuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'kategori_program' => [
                        'label' => 'Kategori program',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'program' => [
                        'label' => 'Program bantuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'nilai_kebutuhan' => [
                        'label' => 'Nilai yang dibutuhkan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'file_formulir' => [
                        'label' => 'File formulir',
                        'rules' => 'uploaded[file_formulir]|max_size[file_formulir,10128]|ext_in[file_formulir,pdf]|mime_in[file_formulir,application/pdf]',
                        'errors' => [
                            'uploaded' => '{field} tidak boleh kosong',
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 10MB',
                            'ext_in' => 'Mohon maaf, {field} harus dalam format pdf',
                            'mime_in' => 'Mohon maaf, {field} bukan pdf',
                        ]
                    ],
                    'file_proposal' => [
                        'label' => 'File Proposal',
                        'rules' => 'uploaded[file_proposal]|max_size[file_proposal,10128]|ext_in[file_proposal,pdf]|mime_in[file_proposal,application/pdf]',
                        'errors' => [
                            'uploaded' => '{field} tidak boleh kosong',
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 10MB',
                            'ext_in' => 'Mohon maaf, {field} harus dalam format pdf',
                            'mime_in' => 'Mohon maaf, {field} bukan pdf',
                        ]
                    ],
                    'file_ktp' => [
                        'label' => 'File KTP',
                        'rules' => 'max_size[file_ktp,4096]|ext_in[file_ktp,pdf,jpeg,jpg,png]|mime_in[file_ktp,application/pdf,image/jpeg,image/jpg,image/png]',
                        'errors' => [
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 4MB',
                            'ext_in' => 'Mohon maaf, semua {field} harus dalam format pdf/jpg/jpeg/png',
                            'mime_in' => 'Mohon maaf, {field} harus dalam format pdf/jpg/jpeg/png',
                        ]
                    ],
                    'file_kk' => [
                        'label' => 'File KK',
                        'rules' => 'max_size[file_kk,4096]|ext_in[file_kk,pdf,jpeg,jpg,png]|mime_in[file_kk,application/pdf,image/jpeg,image/jpg,image/png]',
                        'errors' => [
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 4MB',
                            'ext_in' => 'Mohon maaf, semua {field} harus dalam format pdf/jpg/jpeg/png',
                            'mime_in' => 'Mohon maaf, {field} harus dalam format pdf/jpg/jpeg/png',
                        ]
                    ],

                ];
            } else {
                $valid = [
                    'jenis_bantuan' => [
                        'label' => 'Jenis bantuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'kategori_program' => [
                        'label' => 'Kategori program',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'program' => [
                        'label' => 'Program bantuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'nilai_kebutuhan' => [
                        'label' => 'Nilai yang dibutuhkan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'nama_lembaga' => [
                        'label' => 'Nama lembaga',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'alamat_lembaga' => [
                        'label' => 'Nilai yang dibutuhkan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'nomor_lembaga' => [
                        'label' => 'Nomor lembaga',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'file_formulir' => [
                        'label' => 'File formulir',
                        'rules' => 'uploaded[file_formulir]|max_size[file_formulir,10128]|ext_in[file_formulir,pdf]|mime_in[file_formulir,application/pdf]',
                        'errors' => [
                            'uploaded' => '{field} tidak boleh kosong',
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 10MB',
                            'ext_in' => 'Mohon maaf, {field} harus dalam format pdf',
                            'mime_in' => 'Mohon maaf, {field} bukan pdf',
                        ]
                    ],
                    'file_proposal' => [
                        'label' => 'File Proposal',
                        'rules' => 'uploaded[file_proposal]|max_size[file_proposal,10128]|ext_in[file_proposal,pdf]|mime_in[file_proposal,application/pdf]',
                        'errors' => [
                            'uploaded' => '{field} tidak boleh kosong',
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 10MB',
                            'ext_in' => 'Mohon maaf, {field} harus dalam format pdf',
                            'mime_in' => 'Mohon maaf, {field} bukan pdf',
                        ]
                    ]
                ];
            }


            if (!$this->validate($valid)) {
                if ($this->request->getVar('jenis_bantuan') == 'Individu') {
                    $msg = [
                        'error' => [
                            'jenis_bantuan' => $validation->getError('jenis_bantuan'),
                            'kategori_program' => $validation->getError('kategori_program'),
                            'program' => $validation->getError('program'),
                            'nilai_kebutuhan' => $validation->getError('nilai_kebutuhan'),
                            'file_formulir' => $validation->getError('file_formulir'),
                            'proposal' => $validation->getError('file_proposal'),
                            'file_ktp' => $validation->getError('file_ktp'),
                            'file_kk' => $validation->getError('file_kk'),
                            'token' => csrf_hash(),
                        ]
                    ];
                } else {
                    $msg = [
                        'error' => [
                            'jenis_bantuan' => $validation->getError('jenis_bantuan'),
                            'kategori_program' => $validation->getError('kategori_program'),
                            'program' => $validation->getError('program'),
                            'nilai_kebutuhan' => $validation->getError('nilai_kebutuhan'),
                            'nama_lembaga' => $validation->getError('nama_lembaga'),
                            'alamat_lembaga' => $validation->getError('alamat_lembaga'),
                            'nomor_lembaga' => $validation->getError('nomor_lembaga'),
                            'file_formulir' => $validation->getError('file_formulir'),
                            'proposal' => $validation->getError('file_proposal'),
                            'token' => csrf_hash(),
                        ]
                    ];
                }
            } else {
                // rubah format nilai
                $strNilaiKebutuhan = $this->request->getVar('nilai_kebutuhan');
                $numbNilaiKebutuhan = str_replace(".", "", $strNilaiKebutuhan);
                $proposal = $this->request->getFile('file_proposal');
                $namaFile = $proposal->getRandomName();
                // simpan surat ket. pemohon ke directory
                $proposal->move('file_proposal', $namaFile);

                $formulir = $this->request->getFile('file_formulir');
                $namaFormulir = $formulir->getRandomName();
                // simpan surat ket. pemohon ke directory
                $formulir->move('file_formulir', $namaFormulir);

                // Nomor Ajuan
                $noAjuan = random_int(10000000, 99999999);
                $cekNomorAjuan = $this->ajuanModel->where('nomor_ajuan', $noAjuan)->countAllResults();
                while ($cekNomorAjuan >= 1) {
                    $noAjuan = random_int(00000000, 99999999);
                    $cekNomorAjuan = $this->ajuanModel->where('nomor_ajuan', $noAjuan)->countAllResults();
                }
                $dataAjuan = [
                    'nomor_ajuan' => $noAjuan,
                    'nik' => $this->request->getVar('nik'),
                    'id_kategori_program' => $this->request->getVar('kategori_program'),
                    'id_program' => $this->request->getVar('program'),
                    'nilai_diajukan' => $numbNilaiKebutuhan,
                    'deskripsi_ajuan' => $this->request->getVar('deskripsi_permohonan'),
                    'jenis_ajuan' => $this->request->getVar('jenis_bantuan'),
                    'file_formulir' => $namaFormulir,
                    'file_proposal' => $namaFile,
                    'status_ajuan' => 1,
                ];

                $this->ajuanModel->transBegin();
                $this->ajuanModel->insert($dataAjuan);
                if ($this->ajuanModel->transStatus() === false) {
                    $this->ajuanModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data ajuan tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->ajuanModel->transCommit();
                    // Jika Ajuan Lembaga = Simpan lembaga
                    if ($this->request->getVar('jenis_bantuan') == 'Lembaga') {
                        $dataLembaga = [
                            'nomor_ajuan' => $noAjuan,
                            'nama_lembaga' => $this->request->getVar('nama_lembaga'),
                            'alamat_lembaga' => $this->request->getVar('alamat_lembaga'),
                            'nomor_lembaga' => $this->request->getVar('nomor_lembaga')
                        ];
                        $this->lembagaModel->transBegin();
                        $this->lembagaModel->insert($dataLembaga);
                        if ($this->lembagaModel->transStatus() === false) {
                            $this->lembagaModel->transRollback();
                            $msg = [
                                'gagal' => [
                                    'pesan' => 'Data lembaga tidak dapat disimpan'
                                ]
                            ];
                        } else {
                            $this->lembagaModel->transCommit();
                        }
                    } elseif ($this->request->getVar('jenis_bantuan') == 'Individu') {
                        $nik = $this->request->getPost('nik_mustahik');
                        //file ktp
                        $foto_ktp = $this->request->getFile('file_ktp');
                        if (is_uploaded_file($_FILES['file_ktp']['tmp_name'])) {
                            $namaFileKTP = $foto_ktp->getRandomName();
                            $foto_ktp->move('file_ktp', $namaFileKTP);
                        } else {
                            $namaFileKTP =  $this->request->getPost('nama_file_ktp_old');
                        }

                        // KK
                        $no_kk = $this->request->getPost('no_kk');
                        $foto_kk = $this->request->getFile('file_kk');
                        if (is_uploaded_file($_FILES['file_kk']['tmp_name'])) {
                            $namaFileKK = $foto_kk->getRandomName();
                            $foto_kk->move('file_kk', $namaFileKK);
                        } else {
                            $namaFileKK = $this->request->getPost('nama_file_kk_old');
                        }

                        $nama_lengkap = $this->request->getPost('nama');
                        $jenkel = $this->request->getPost('jenkel');
                        $agama = $this->request->getVar('agama');
                        $alamat_ktp = $this->request->getPost('alamat_ktp');
                        $provinsi = $this->request->getPost('provinsi');
                        $kabupaten = $this->request->getPost('kabupaten');
                        $kecamatan = $this->request->getPost('kecamatan');
                        $kelurahan = $this->request->getPost('kelurahan');
                        $pendidikan = $this->request->getPost('pendidikan');
                        $marital = $this->request->getPost('marital');
                        $pekerjaan = $this->request->getPost('pekerjaan');
                        $penghasilan = $this->request->getPost('penghasilan');
                        $jml_keluarga = $this->request->getPost('jml_keluarga');
                        $no_handphone = $this->request->getPost('no_handphone');
                        $email_mustahik = $this->request->getPost('email_mustahik');
                        $tempat_lahir = $this->request->getPost('tempat_lahir');
                        $tgl_lahir = $this->request->getPost('tgl_lahir');

                        $this->individuModel->simpan($noAjuan, $nik, $namaFileKTP, $no_kk, $namaFileKK, $nama_lengkap, $jenkel, $agama, $alamat_ktp, $provinsi, $kabupaten, $kecamatan, $kelurahan, $pendidikan, $marital, $pekerjaan, $penghasilan, $jml_keluarga, $no_handphone, $email_mustahik, $tempat_lahir, $tgl_lahir);
                    }

                    // Simpan log
                    $data_log = [
                        'nomor_ajuan' => $noAjuan,
                        'status_ajuan' => 1,
                        'tanggal_log' => Time::now(),
                        'catatan_log' => "",
                        'log_created_by' => 'Pemohon'
                    ];
                    $this->logajuanModel->transBegin();
                    $this->logajuanModel->insert($data_log);
                    if ($this->logajuanModel->transStatus() === false) {
                        $this->logajuanModel->transRollback();
                        $msg = [
                            'gagal' => [
                                'pesan' => 'Data log tidak dapat diinsert'
                            ]
                        ];
                    } else {
                        $this->logajuanModel->transCommit();
                        $msg = [
                            'berhasil' => [
                                'pesan' => 'Data ajuan berhasil disimpan. Simpan nomor ajuan ini untuk melihat proses ajuan Anda!',
                                'nomor_ajuan' => $noAjuan,
                                'link' => '/pemohon/pdf_no_ajuan/' . $noAjuan
                            ]
                        ];
                    }
                }
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function proses_cekajuan()
    {
        $hslbenar = $this->request->getVar('hslbenar');
        $jawaban = $this->request->getVar('jawabCpt');
        if (md5($jawaban) == $hslbenar) {
            $nik = $this->request->getPost('nik');
            $countNik = $this->ajuanModel->where('nik', $nik)->countAllResults();
            if ($countNik == 0) {
                session()->setFlashdata('pesan', 'Mohon maaf, nik belum terdaftar dalam ajuan');
                return redirect()->to('/front/formulir_cekajuan');
            } else {
                $nomor_ajuan = $this->request->getPost('nomor_ajuan');
                $countAjuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)->where('nik', $nik)->countAllResults();
                if ($countAjuan == 0) {
                    session()->setFlashdata('pesan', 'Mohon maaf, nomor ajuan anda tidak terdaftar');
                    return redirect()->to('/front/formulir_cekajuan');
                } else {
                    $ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)
                        ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                        ->first();
                    $dapat_session = [
                        'login' => true,
                        'priv_user' => 0,
                        'nama' => $ajuan['nama_pemohon'],
                        'id_ajuan' => $ajuan['id_ajuan'],
                        'nomor_ajuan' => $ajuan['nomor_ajuan'],
                        'nik' => $ajuan['nik'],
                        'halaman' => 'pemohon',
                        // 'status_ajuan' => $ajuan['status_ajuan']
                    ];
                    $this->session->set($dapat_session);
                    return redirect()->to('/pemohon/index');
                }
            }
        } else {
            session()->setFlashdata('pesan', 'Mohon maaf, hasil perhitungan Anda salah');
            return redirect()->to('/front/formulir_cekajuan');
        }
    }

    public function halaman_edit_ajuan()
    {
        $nomor_ajuan = $this->session->get('nomor_ajuan');
        $cek_ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)->first();
        if ($cek_ajuan['jenis_ajuan'] == 'Lembaga') {
            $data_ajuan = $this->ajuanModel->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('ad_kategori_program', 'ad_kategori_program.id_kategori_program = tr_ajuan.id_kategori_program')
                ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->first();
        } else {
            $data_ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)
                ->join('ad_kategori_program', 'ad_kategori_program.id_kategori_program = tr_ajuan.id_kategori_program')
                ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                ->first();
        }

        $data = [
            'halaman' => 'halaman_ajuan',
            'data_pilar' => $this->pilarModel->findAll(),
            'data_ktg_program' => $this->kategoriModel->findAll(),
            'data_program' => $this->programModel->findAll(),
            'syarat_program' => $this->syaratModel->where('id_program', $data_ajuan['id_program'])->findAll(),
            'ajuan' => $data_ajuan,
        ];
        return view('pemohon/edit_ajuan', $data);
    }

    public function simpan_edit_ajuan()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $validation = \Config\Services::validation();
            // Jika jenis ajuan individu
            if ($this->request->getVar('jenis_bantuan') == 'Individu') {
                $valid = [
                    'nilai_kebutuhan' => [
                        'label' => 'Nilai yang dibutuhkan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    'file_formulir' => [
                        'label' => 'File formulir',
                        'rules' => 'max_size[file_formulir,10128]|ext_in[file_formulir,pdf]|mime_in[file_formulir,application/pdf]',
                        'errors' => [
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 10MB',
                            'ext_in' => 'Mohon maaf, {field} harus dalam format pdf',
                            'mime_in' => 'Mohon maaf, {field} bukan pdf',
                        ]
                    ],
                    'file_proposal' => [
                        'label' => 'File Proposal',
                        'rules' => 'max_size[file_proposal,10128]|ext_in[file_proposal,pdf]|mime_in[file_proposal,application/pdf]',
                        'errors' => [
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 10MB',
                            'ext_in' => 'Mohon maaf, {field} harus dalam format pdf',
                            'mime_in' => 'Mohon maaf, {field} bukan pdf',
                        ]
                    ]
                ];
            } else {
                $valid = [
                    'nilai_kebutuhan' => [
                        'label' => 'Nilai yang dibutuhkan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong'
                        ]
                    ],
                    // 'nama_lembaga' => [
                    //     'label' => 'Nama lembaga',
                    //     'rules' => 'required',
                    //     'errors' => [
                    //         'required' => '{field} tidak boleh kosong'
                    //     ]
                    // ],
                    // 'alamat_lembaga' => [
                    //     'label' => 'Nilai yang dibutuhkan',
                    //     'rules' => 'required',
                    //     'errors' => [
                    //         'required' => '{field} tidak boleh kosong'
                    //     ]
                    // ],
                    // 'nomor_lembaga' => [
                    //     'label' => 'Nomor lembaga',
                    //     'rules' => 'required',
                    //     'errors' => [
                    //         'required' => '{field} tidak boleh kosong'
                    //     ]
                    // ],
                    'file_formulir' => [
                        'label' => 'File formulir',
                        'rules' => 'max_size[file_formulir,10128]|ext_in[file_formulir,pdf]|mime_in[file_formulir,application/pdf]',
                        'errors' => [
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 10MB',
                            'ext_in' => 'Mohon maaf, {field} harus dalam format pdf',
                            'mime_in' => 'Mohon maaf, {field} bukan pdf',
                        ]
                    ],
                    'file_proposal' => [
                        'label' => 'File Proposal',
                        'rules' => 'max_size[file_proposal,10128]|ext_in[file_proposal,pdf]|mime_in[file_proposal,application/pdf]',
                        'errors' => [
                            'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 10MB',
                            'ext_in' => 'Mohon maaf, {field} harus dalam format pdf',
                            'mime_in' => 'Mohon maaf, {field} bukan pdf',
                        ]
                    ]
                ];
            }


            if (!$this->validate($valid)) {
                if ($this->request->getVar('jenis_bantuan') == 'Individu') {
                    $msg = [
                        'error' => [
                            // 'jenis_bantuan' => $validation->getError('jenis_bantuan'),
                            // 'kategori_program' => $validation->getError('kategori_program'),
                            // 'program' => $validation->getError('program'),
                            'nilai_kebutuhan' => $validation->getError('nilai_kebutuhan'),
                            'file_formulir' => $validation->getError('file_formulir'),
                            'proposal' => $validation->getError('file_proposal'),
                            'token' => csrf_hash(),
                        ]
                    ];
                } else {
                    $msg = [
                        'error' => [
                            // 'jenis_bantuan' => $validation->getError('jenis_bantuan'),
                            // 'kategori_program' => $validation->getError('kategori_program'),
                            // 'program' => $validation->getError('program'),
                            'nilai_kebutuhan' => $validation->getError('nilai_kebutuhan'),
                            // 'nama_lembaga' => $validation->getError('nama_lembaga'),
                            // 'alamat_lembaga' => $validation->getError('alamat_lembaga'),
                            // 'nomor_lembaga' => $validation->getError('nomor_lembaga'),
                            'file_formulir' => $validation->getError('file_formulir'),
                            'proposal' => $validation->getError('file_proposal'),
                            'token' => csrf_hash(),
                        ]
                    ];
                }
            } else {
                $proposal = $this->request->getFile('file_proposal');
                if ($proposal == "") {
                    $namaFile = $this->request->getVar('proposal_lama');
                } else {
                    $namaFile = $proposal->getRandomName();
                    // simpan surat ket. pemohon ke directory
                    $proposal->move('file_proposal', $namaFile);
                }

                $formulir = $this->request->getFile('file_formulir');
                if ($formulir == "") {
                    $namaFormulir = $this->request->getVar('formulir_lama');
                } else {
                    $namaFormulir = $formulir->getRandomName();
                    // simpan surat ket. pemohon ke directory
                    $formulir->move('file_formulir', $namaFormulir);
                }

                // rubah format nilai
                $strNilaiKebutuhan = $this->request->getVar('nilai_kebutuhan');
                $numbNilaiKebutuhan = str_replace(".", "", $strNilaiKebutuhan);

                $dataAjuan = [
                    'nilai_diajukan' => $numbNilaiKebutuhan,
                    'deskripsi_ajuan' => $this->request->getVar('deskripsi_permohonan'),
                    'file_formulir' => $namaFormulir,
                    'file_proposal' => $namaFile,
                    'status_ajuan' => 1,
                ];

                $id_ajuan = $this->session->get('id_ajuan');

                $this->ajuanModel->transBegin();
                $this->ajuanModel->update($id_ajuan, $dataAjuan);
                if ($this->ajuanModel->transStatus() === false) {
                    $this->ajuanModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data ajuan tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->ajuanModel->transCommit();
                    // Jika Ajuan Lembaga = Simpan lembaga
                    // if ($this->request->getVar('jenis_bantuan') == 'Lembaga') {
                    //     $dataLembaga = [
                    //         'nomor_ajuan' => $$this->session->get('nomor_ajuan'),
                    //         'nama_lembaga' => $this->request->getVar('nama_lembaga'),
                    //         'alamat_lembaga' => $this->request->getVar('alamat_lembaga'),
                    //         'nomor_lembaga' => $this->request->getVar('nomor_lembaga')
                    //     ];
                    //     $this->lembagaModel->transBegin();
                    //     $this->lembagaModel->where('nomor_ajuan', $this->session->get('nomor_ajuan'))->update($dataLembaga);
                    //     if ($this->lembagaModel->transStatus() === false) {
                    //         $this->lembagaModel->transRollback();
                    //         $msg = [
                    //             'gagal' => [
                    //                 'pesan' => 'Data lembaga tidak dapat disimpan'
                    //             ]
                    //         ];
                    //     } else {
                    //         $this->lembagaModel->transCommit();
                    //     }
                    // }

                    // Simpan log
                    $data_log = [
                        'nomor_ajuan' => $this->session->get('nomor_ajuan'),
                        'status_ajuan' => 1,
                        'tanggal_log' => new Time('now', 'Asia/Jakarta', 'en_US'),
                        'catatan_log' => "Ajuan diedit",
                        'log_created_by' => 'Pemohon'
                    ];
                    $this->logajuanModel->transBegin();
                    $this->logajuanModel->insert($data_log);
                    if ($this->logajuanModel->transStatus() === false) {
                        $this->logajuanModel->transRollback();
                        $msg = [
                            'gagal' => [
                                'pesan' => 'Data log tidak dapat diinsert'
                            ]
                        ];
                    } else {
                        $this->logajuanModel->transCommit();
                        $msg = [
                            'berhasil' => [
                                'pesan' => 'Data ajuan berhasil disimpan. Simpan nomor ajuan ini untuk melihat proses ajuan Anda!',
                                'nomor_ajuan' => $this->session->get('nomor_ajuan')
                            ]
                        ];
                    }
                }
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function pdf_no_ajuan($nomor_ajuan)
    {
        // cek ajuan lembaga/individu
        $ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)->first();
        if ($ajuan['jenis_ajuan'] == 'Individu') {
            $data_ajuan =  $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                ->first();
        } else {
            $data_ajuan =  $this->ajuanModel->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                ->first();
        }
        $data = [
            'data_ajuan' => $data_ajuan,
            'tanggal' => Time::now()
        ];

        $html = view("/pemohon/pdf/pdf_nomor_ajuan", $data);

        $pdf = new TCPDF("L", PDF_UNIT, "A5", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Puslogin UMS');
        $pdf->SetTitle('Nomor Ajuan');
        $pdf->SetSubject('Nomor Ajuan ' . $nomor_ajuan);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 1, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->addPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output("$nomor_ajuan.pdf", 'I');
    }

    public function do_unggah_dokumentasi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = [
                'file_dokumentasi' => [
                    'label' => 'file',
                    'rules' => 'uploaded[file_dokumentasi]|max_size[file_dokumentasi,4096]|ext_in[file_dokumentasi,pdf]|mime_in[file_dokumentasi,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Form tidak boleh kosong',
                        'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 4MB',
                        'ext_in' => 'Mohon maaf, semua {field} harus dalam format pdf',
                        'mime_in' => 'Mohon maaf, {field} harus dalam format pdf',
                    ]
                ]
            ];

            if (!$this->validate($valid)) {
                $msg = [
                    'error' => [
                        'file_dokumentasi' => $validation->getError('file_dokumentasi'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $no_ajuan = $this->request->getVar('no_ajuan');
                $formulir = $this->request->getFile('file_dokumentasi');
                $namaFormulir = $formulir->getRandomName();
                // simpan surat ket. pemohon ke directory
                $formulir->move('file_dokumentasi', $namaFormulir);
                $msg = $this->dokumentasiModel->simpan($no_ajuan, $namaFormulir, 'terunggah');
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function do_unggah_kuitansi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = [
                'file_kuitansi' => [
                    'label' => 'file',
                    'rules' => 'uploaded[file_kuitansi]|max_size[file_kuitansi,4096]|ext_in[file_kuitansi,pdf]|mime_in[file_kuitansi,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Form tidak boleh kosong',
                        'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 4MB',
                        'ext_in' => 'Mohon maaf, semua {field} harus dalam format pdf',
                        'mime_in' => 'Mohon maaf, {field} harus dalam format pdf',
                    ]
                ]
            ];

            if (!$this->validate($valid)) {
                $msg = [
                    'error' => [
                        'file_kuitansi' => $validation->getError('file_kuitansi'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $no_ajuan = $this->request->getVar('no_ajuan');
                $formulir = $this->request->getFile('file_kuitansi');
                $namaFormulir = $formulir->getRandomName();
                // simpan surat ket. pemohon ke directory
                $formulir->move('file_kuitansi', $namaFormulir);
                $msg = $this->kuitansiModel->simpan($no_ajuan, $namaFormulir, 'terunggah');
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }
}
