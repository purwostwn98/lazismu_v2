<?php

namespace App\Controllers;

use App\Models\PenghimpunanModel;
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
use App\Models\FormB3Model;
use App\Models\ProgramModel;
use App\Models\PilarModel;
use App\Models\KategoriModel;
use App\Models\KategoripenerimaModel;
use App\Models\KuitansiModel;
use App\Models\SyaratModel;
use App\Models\UsersModel;
use App\Models\IndividuModel;
use App\Models\MuzakiModel;
use App\Models\NotulensiModel;
use App\Models\NotulensiAgendaModel;
use App\Models\NotulensiAjuanModel;
use App\Models\PenghimpunanKtgModel;
use App\Models\PenghimpunanSubktgModel;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\IOFactory;
use TCPDF;

class Admin extends BaseController
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
    protected $kategori_penerimaModel;
    protected $bentukbantuanModel;
    protected $programModel;
    protected $pilarModel;
    protected $kategoriProgramModel;
    protected $syaratModel;
    protected $userModel;
    protected $bulan;
    protected $dokumentasiModel;
    protected $kuitansiModel;
    protected $individuModel;
    protected $muzakiModel;
    protected $penghimpunanModel;
    protected $penghimpunanKtgModel;
    protected $penghimpunanSubktgModel;
    protected $formB3Model;
    protected $notulensiModel;
    protected $notulensiAgendaModel;
    protected $notulensiAjaunModel;

    public function __construct()
    {
        $this->penghimpunanModel = new PenghimpunanModel();
        $this->penghimpunanKtgModel = new PenghimpunanKtgModel();
        $this->penghimpunanSubktgModel = new PenghimpunanSubktgModel();
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
        $this->kategori_penerimaModel = new KategoripenerimaModel();
        $this->programModel = new ProgramModel();
        $this->pilarModel = new PilarModel();
        $this->kategoriProgramModel = new KategoriModel();
        $this->syaratModel = new SyaratModel();
        $this->userModel = new UsersModel();
        $this->dokumentasiModel = new DokumentasiModel();
        $this->kuitansiModel = new KuitansiModel();
        $this->individuModel = new IndividuModel();
        $this->muzakiModel = new MuzakiModel();
        $this->formB3Model = new FormB3Model();
        $this->notulensiModel = new NotulensiModel();
        $this->notulensiAgendaModel = new NotulensiAgendaModel();
        $this->notulensiAjaunModel = new NotulensiAjuanModel();
        $this->bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
    }

    public function index()
    {

        if ($this->request->getPost('filterTgl') == 'filter') {
            $filter = 'filter';
            $tgAwal = $this->request->getPost('tgAwal');
            $tgAhir = $this->request->getPost('tgAkhir');
            $tgl = explode('-', strval($tgAwal));
            $tgl2 = explode('-', strval($tgAhir));
            $tglAwal = $tgl[2] . ' ' . $this->bulan[(int)$tgl[1]] . ' ' . $tgl[0];
            $tglAkhir = $tgl2[2] . ' ' . $this->bulan[(int)$tgl2[1]] . ' ' . $tgl2[0];
            $myTime = Time::createFromDate($tgl2[0], $tgl2[1], $tgl2[2], 'Asia/Jakarta', 'en_US');
        } elseif ($this->request->getGet('hpsFilter') == 'noFilter') {
            $filter = 'noFilter';
            $tgAwal = 0000 - 00 - 00;
            $tgAhir = new Time('now', 'Asia/Jakarta', 'en_US');
            $tglAwal = "Semua Data";
            $tglAkhir = "";
            $myTime = Time::now('Asia/Jakarta', 'en_US');
        } else {
            $filter = 'noFilter';
            $tgAwal = 0000 - 00 - 00;
            $tgAhir = new Time('now', 'Asia/Jakarta', 'en_US');
            $tglAwal = "Semua Data";
            $tglAkhir = "";
            $myTime = Time::now('Asia/Jakarta', 'en_US');
        }

        // Statistik Dana Tersalurkan (Infaq Umum)
        $ktg_infak = $this->kategori_penerimaModel->where('id_dana_dari', 'Infaq Umum')->findAll();
        $nominal_infak = 0;
        foreach ($ktg_infak as $key => $ktg) {
            $jumlah_ajuan = $this->berita_acaraModel->where('kategori_penerima', $ktg['id_kategori_penerima'])
                ->where('ba_created_at >=', $tgAwal)
                ->where('ba_created_at <=', $tgAhir)
                ->selectSum('nilai_penyerahan')->first();
            $list_infak[$ktg['ket_kategori_penerima']] = $jumlah_ajuan['nilai_penyerahan'];
            arsort($list_infak);
            $nominal_infak += $jumlah_ajuan['nilai_penyerahan'];
        }

        // Statistik Dana Tersalurkan (Zakat)
        $ktg_zakat = $this->kategori_penerimaModel->where('id_dana_dari', 'Zakat')->findAll();
        $nominal_zakat = 0;
        foreach ($ktg_zakat as $key => $ktg) {
            $jumlah_ajuan = $this->berita_acaraModel->where('kategori_penerima', $ktg['id_kategori_penerima'])
                ->where('ba_created_at >=', $tgAwal)
                ->where('ba_created_at <=', $tgAhir)
                ->selectSum('nilai_penyerahan')->first();
            $list_zakat[$ktg['ket_kategori_penerima']] = $jumlah_ajuan['nilai_penyerahan'];
            arsort($list_zakat);
            $nominal_zakat += $jumlah_ajuan['nilai_penyerahan'];
        }

        // Statistik Dana Tersalurkan (Sosial Keagamaan)
        $ktg_sosial = $this->kategori_penerimaModel->where('id_dana_dari', 'Infaq Terikat')->findAll();
        $nominal_sosial = 0;
        foreach ($ktg_sosial as $key => $ktg) {
            $jumlah_ajuan = $this->berita_acaraModel->where('kategori_penerima', $ktg['id_kategori_penerima'])
                ->where('ba_created_at >=', $tgAwal)
                ->where('ba_created_at <=', $tgAhir)
                ->selectSum('nilai_penyerahan')->first();
            $list_sosial[$ktg['ket_kategori_penerima']] = $jumlah_ajuan['nilai_penyerahan'];
            arsort($list_sosial);
            $nominal_sosial += $jumlah_ajuan['nilai_penyerahan'];
        }

        // Statistik Dana Tersalurkan (Amil)
        $ktg_amil = $this->kategori_penerimaModel->where('id_dana_dari', 'Amil')->findAll();
        $nominal_amil = 0;
        foreach ($ktg_amil as $key => $ktg) {
            $jumlah_ajuan = $this->berita_acaraModel->where('kategori_penerima', $ktg['id_kategori_penerima'])
                ->where('ba_created_at >=', $tgAwal)
                ->where('ba_created_at <=', $tgAhir)
                ->selectSum('nilai_penyerahan')->first();
            $list_amil[$ktg['ket_kategori_penerima']] = $jumlah_ajuan['nilai_penyerahan'];
            arsort($list_amil);
            $nominal_amil += $jumlah_ajuan['nilai_penyerahan'];
        }

        // Statistik Program
        $kategori_program = $this->kategoriProgramModel->findAll();
        foreach ($kategori_program as $key => $ktg) {
            $jumlah_ajuan = $this->ajuanModel->where('id_kategori_program', $ktg['id_kategori_program'])
                ->where('tgl_diajukan >=', $tgAwal)
                ->where('tgl_diajukan <=', $tgAhir)
                ->countAllResults();
            $list_ktg[$ktg['nama_kategori']] = $jumlah_ajuan;
            arsort($list_ktg);
        }
        // Statistik Pilar
        $pilar_program = $this->pilarModel->findAll();
        foreach ($pilar_program as $key => $pilar) {
            $jumlah_ajuan = $this->ajuanModel
                ->where('tgl_diajukan >=', $tgAwal)
                ->where('tgl_diajukan <=', $tgAhir)
                ->join('ad_kategori_program as ktg', 'ktg.id_kategori_program = tr_ajuan.id_kategori_program')
                ->join('dt_pilar', 'dt_pilar.id_pilar = ktg.id_pilar')
                ->where('ktg.id_pilar', $pilar['id_pilar'])->countAllResults();
            $list_pilar[$pilar['nama_pilar']] = $jumlah_ajuan;
            arsort($list_pilar);
        }


        // time series bulanan
        // $myTime = Time::now('Asia/Jakarta', 'en_US');
        for ($i = 1; $i < 13; $i++) {
            $jumlah_ajuan = $this->ajuanModel->where('Month(tgl_diajukan)', $i)
                ->where('Year(tgl_diajukan)', $myTime->getYear())
                ->countAllResults();
            $list_ajuan[$i] = $jumlah_ajuan;
        }
        $ajuan = $this->ajuanModel;
        $data = [
            'halaman' => 'dashboard_admin',
            'count_ajuan_baru' => $ajuan->where('status_ajuan', 1)
                ->where('tgl_diajukan >=', $tgAwal)
                ->where('tgl_diajukan <=', $tgAhir)
                ->countAllResults(),
            'count_ajuan_proses' => $ajuan->whereIn('status_ajuan', [2, 3, 4, 5])
                ->where('tgl_diajukan >=', $tgAwal)
                ->where('tgl_diajukan <=', $tgAhir)
                ->countAllResults(),
            'count_ajuan_rutin' => $ajuan->where('status_ajuan', 8)
                ->where('tgl_diajukan >=', $tgAwal)
                ->where('tgl_diajukan <=', $tgAhir)
                ->where('sifat_bantuan', 'Rutin')
                ->countAllResults(),
            'count_ajuan_selesai' => $ajuan->whereIn('status_ajuan', [6, 7, 9])
                ->where('tgl_diajukan >=', $tgAwal)
                ->where('tgl_diajukan <=', $tgAhir)
                ->countAllResults(),
            'total_dana' => $this->berita_acaraModel
                ->where('tanggal_penyerahan >=', $tgAwal)
                ->where('tanggal_penyerahan <=', $tgAhir)
                ->selectSum('nilai_penyerahan')->first(),
            'list_infak' => $list_infak,
            'nominal_infak' => $nominal_infak,
            'list_zakat' => $list_zakat,
            'nominal_zakat' => $nominal_zakat,
            'list_sosial' => $list_sosial,
            'nominal_sosial' => $nominal_sosial,
            'list_amil' => $list_amil,
            'nominal_amil' => $nominal_amil,
            'list_ktg' => $list_ktg,
            'list_pilar' => $list_pilar,
            'list_ajuan' => $list_ajuan,
            'tahun' => $myTime->getYear(),
            'filter' => $filter,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'norm_tglAwal' => $tgAwal,
            'norm_tglAkhir' => $tgAhir,
        ];
        return view('admin/dashboard', $data);
    }

    public function ekspor_excel()
    {
        if ($this->request->getVar('filter') == 'filter') {
            $tgAwal = $this->request->getVar('tgAwal');
            $tgAhir = $this->request->getVar('tgAkhir');
            $tgl = explode('-', $tgAwal);
            $tgl2 = explode('-', $tgAhir);
            $tglAwal = $tgl[2] . ' ' . $this->bulan[(int)$tgl[1]] . ' ' . $tgl[0];
            $tglAkhir = $tgl2[2] . ' ' . $this->bulan[(int)$tgl2[1]] . ' ' . $tgl2[0];
            $label = $tglAwal . ' - ' . $tglAkhir;
        } else {
            //$tgAwal = Time::parse('March 9, 2016 12:00:00', 'Asia/Jakarta');
            $tgAwal = 0000 - 00 - 00;
            $tgAhir = new Time('now', 'Asia/Jakarta', 'en_US');
            $tglAwal = "Semua Data";
            $tglAkhir = "";
            $label = 'semua data';
        }

        $file_excel = $_SERVER["DOCUMENT_ROOT"] . '/template_excel/' . 'template_report.xlsx';
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($file_excel);

        // Keterangan filter
        $spreadsheet->setActiveSheetIndexByName('report_ajuan')
            ->setCellValue('B7', 'Filter : ' . $label);

        // Query Ajuan
        $ajuan = $this->ajuanModel
            ->where('tgl_diajukan >=', $tgAwal)
            ->where('tgl_diajukan <=', $tgAhir)
            ->join('tr_lembaga', 'tr_ajuan.nomor_ajuan = tr_lembaga.nomor_ajuan', 'left')
            ->join('tr_pemohon as pmh', 'pmh.nik = tr_ajuan.nik')
            ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
            ->join('ad_kategori_program as ktg', 'ktg.id_kategori_program = tr_ajuan.id_kategori_program')
            ->join('dt_pilar', 'dt_pilar.id_pilar = ktg.id_pilar')
            ->join('dt_status_ajuan as sts_ajn', 'sts_ajn.id_status = tr_ajuan.status_ajuan')
            ->join('dt_kelurahan as kel', 'kel.id_kelurahan = pmh.id_kelurahan')
            ->join('dt_kecamatan as kec', 'kec.id_kecamatan = pmh.id_kecamatan')
            ->join('dt_kabupaten as kab', 'kab.id_kabupaten = pmh.id_kabupaten')
            ->join('dt_provinsi as prov', 'prov.id_provinsi = pmh.id_provinsi')
            ->select('tr_ajuan.*, tr_lembaga.nama_lembaga, tr_lembaga.alamat_lembaga, tr_lembaga.nomor_lembaga, pmh.*, ad_program.nama_program, ktg.nama_kategori, dt_pilar.nama_pilar, sts_ajn.keterangan_status, kel.nama_kelurahan, kec.nama_kecamatan,
            kab.nama_kabupaten, prov.nama_provinsi')
            ->findAll();
        $no = 0;
        $CurrentRow = 9;
        foreach ($ajuan as $n) {
            $spreadsheet->setActiveSheetIndexByName('report_ajuan')
                ->setCellValue('A' . $CurrentRow, $no + 1)
                ->setCellValue('B' . $CurrentRow, $n['tgl_diajukan'])
                ->setCellValue('C' . $CurrentRow, strval($n['nomor_ajuan']))
                ->setCellValue('D' . $CurrentRow, sprintf("%d", $n['nik']))
                ->setCellValue('E' . $CurrentRow, $n['nama_pemohon'])
                ->setCellValue('F' . $CurrentRow, $n['jenis_kelamin'])
                ->setCellValue('G' . $CurrentRow, $n['tanggal_lahir'])
                ->setCellValue('H' . $CurrentRow, $n['agama'])
                ->setCellValue('I' . $CurrentRow, $n['telepon'])
                ->setCellValue('J' . $CurrentRow, $n['email'])
                ->setCellValue('K' . $CurrentRow, $n['alamat_detail'])
                ->setCellValue('L' . $CurrentRow, $n['nama_kelurahan'])
                ->setCellValue('M' . $CurrentRow, $n['nama_kecamatan'])
                ->setCellValue('N' . $CurrentRow, $n['nama_kabupaten'])
                ->setCellValue('O' . $CurrentRow, $n['nama_provinsi'])
                ->setCellValue('P' . $CurrentRow, $n['nama_pilar'])
                ->setCellValue('Q' . $CurrentRow, $n['nama_kategori'])
                ->setCellValue('R' . $CurrentRow, $n['nama_program'])
                ->setCellValue('S' . $CurrentRow, $n['nilai_diajukan'])
                ->setCellValue('T' . $CurrentRow, $n['deskripsi_ajuan'])
                ->setCellValue('U' . $CurrentRow, $n['jenis_ajuan'])
                ->setCellValue('V' . $CurrentRow, $n['nama_lembaga'])
                ->setCellValue('W' . $CurrentRow, $n['alamat_lembaga'])
                ->setCellValue('X' . $CurrentRow, $n['nomor_lembaga'])
                ->setCellValue('Y' . $CurrentRow, $n['sifat_bantuan'])
                ->setCellValue('Z' . $CurrentRow, $n['nilai_disetujui'])
                ->setCellValue('AA' . $CurrentRow, $n['keterangan_status'])
                ->setCellValue('AB' . $CurrentRow, $n['status_tersalurkan']);
            $CurrentRow++;
            $no++;
        }

        $spreadsheet->getActiveSheet()->getStyle('A9:A' . $CurrentRow)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

        // for ($i = $CurrentRow; $i <= 350; $i++) {
        //     $spreadsheet->setActiveSheetIndexByName('report_ajuan')->getRowDimension($i)->setOutlineLevel(1);
        //     $spreadsheet->setActiveSheetIndexByName('report_ajuan')->getRowDimension($i)->setVisible(false);
        // }
        // $spreadsheet->setActiveSheetIndexByName('report_ajuan')->getRowDimension(351)->setCollapsed(true);

        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=report_ajuan_$label.xlsx");
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $writer->save('php://output');
        exit();
    }

    public function dftr_ajuan_i()
    {
        $data = [
            'halaman' => 'daftar_ajuan_i',
        ];
        return view('admin/ajuan_individu', $data);
    }

    public function dftr_ajuan_L()
    {
        $data = [
            'halaman' => 'daftar_ajuan_L',
        ];
        return view('admin/ajuan_lembaga', $data);
    }

    public function tabel_baru()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $jenis = $this->request->getVar('jenis');
            if ($jenis == 'baru_lbg') {
                $ajuan_baru = $this->ajuanModel->whereIn('status_ajuan', [0, 1])->where('jenis_ajuan', 'Lembaga')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            } else {
                $ajuan_baru = $this->ajuanModel->whereIn('status_ajuan', [0, 1])->where('jenis_ajuan', 'Individu')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            }
            // print_r($ajuan_baru);
            $data = [
                'jenis' => $jenis,
                'ajuan_baru' => $ajuan_baru
            ];
            $msg = [
                'data' => view('admin/tambahan/tabel_baru', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function tabel_proses()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $jenis = $this->request->getVar('jenis');
            if ($jenis == 'proses_lbg') {
                $ajuan_baru = $this->ajuanModel
                    ->where('status_ajuan >', 1)->where('status_ajuan <', 6)
                    ->where('jenis_ajuan', 'Lembaga')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            } else {
                $ajuan_baru = $this->ajuanModel
                    ->where('status_ajuan >', 1)->where('status_ajuan <', 6)
                    ->where('jenis_ajuan', 'Individu')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            }
            // print_r($ajuan_baru);
            $data = [
                'jenis' => $jenis,
                'ajuan_baru' => $ajuan_baru
            ];
            $msg = [
                'data' => view('admin/tambahan/tabel_proses', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function tabel_rutin()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $jenis = $this->request->getVar('jenis');
            if ($jenis == 'rutin_lbg') {
                $ajuan_baru = $this->ajuanModel
                    ->where('status_ajuan', 8)
                    ->where('jenis_ajuan', 'Lembaga')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            } else {
                $ajuan_baru = $this->ajuanModel
                    ->where('status_ajuan', 8)
                    ->where('jenis_ajuan', 'Individu')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            }
            $data = [
                'jenis' => $jenis,
                'ajuan_baru' => $ajuan_baru
            ];
            $msg = [
                'data' => view('admin/tambahan/tabel_rutin', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function tabel_selesai()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $jenis = $this->request->getVar('jenis');
            if ($jenis == 'selesai_lbg') {
                $ajuan_baru = $this->ajuanModel
                    ->whereIn('status_ajuan', [7, 9])
                    ->where('jenis_ajuan', 'Lembaga')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            } else {
                $ajuan_baru = $this->ajuanModel
                    ->whereIn('status_ajuan', [7, 9])
                    ->where('jenis_ajuan', 'Individu')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            }
            $data = [
                'jenis' => $jenis,
                'ajuan_baru' => $ajuan_baru
            ];
            $msg = [
                'data' => view('admin/tambahan/tabel_selesai', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function tabel_ditolak()
    {
        if ($this->request->isAJAX()) {
            // print_r($_POST);
            $jenis = $this->request->getVar('jenis');
            if ($jenis == 'ditolak_lbg') {
                $ajuan_baru = $this->ajuanModel
                    ->where('status_ajuan', 6)
                    ->where('jenis_ajuan', 'Lembaga')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            } else {
                $ajuan_baru = $this->ajuanModel
                    ->where('status_ajuan', 6)
                    ->where('jenis_ajuan', 'Individu')
                    ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                    ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                    ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                    ->findAll();
            }
            $data = [
                'jenis' => $jenis,
                'ajuan_baru' => $ajuan_baru
            ];
            $msg = [
                'data' => view('admin/tambahan/tabel_selesai', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function tindakan($nik, $nomor_ajuan)
    {
        $cek_ajuan = $this->ajuanModel->where('nik', $nik)->where('nomor_ajuan', $nomor_ajuan)->first();

        if ($cek_ajuan['jenis_ajuan'] == 'Lembaga') {
            $ajuan = $this->ajuanModel->where('tr_ajuan.nik', $nik)->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                ->join('ad_kategori_program as ktg', 'ktg.id_kategori_program = tr_ajuan.id_kategori_program')
                ->join('dt_pilar', 'dt_pilar.id_pilar = ktg.id_pilar')
                ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                ->first();
            $data_individu = [];
        } else {
            $ajuan = $this->ajuanModel->where('tr_ajuan.nik', $nik)->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
                ->join('ad_kategori_program as ktg', 'ktg.id_kategori_program = tr_ajuan.id_kategori_program')
                ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
                ->first();
            $data_individu = $this->individuModel->where('nomor_ajuan', $nomor_ajuan)
                ->join('dt_provinsi as prov', 'tr_individu.provinsi = prov.id_provinsi')
                ->join('dt_kabupaten as kab', 'tr_individu.kabupaten = kab.id_kabupaten')
                ->join('dt_kecamatan as kec', 'tr_individu.kecamatan = kec.id_kecamatan')
                ->join('dt_kelurahan as des', 'tr_individu.desa = des.id_kelurahan')
                ->join('dt_penghasilan as gaji', 'tr_individu.penghasilan = gaji.id_penghasilan')
                ->join('dt_pekerjaan as pekerjaan', 'tr_individu.pekerjaan = pekerjaan.id_pekerjaan')
                ->first();
        }

        $log_ajuan = $this->logajuanModel->where('nomor_ajuan', $nomor_ajuan)
            ->join('dt_status_ajuan as sts', 'sts.id_status = ad_log_ajuan.status_ajuan')->findAll();

        $dokumentasi = $this->dokumentasiModel->where('no_ajuan', $nomor_ajuan)->findAll();
        $kuitansi = $this->kuitansiModel->where('no_ajuan', $nomor_ajuan)->findAll();

        foreach ($log_ajuan as $key => $log) {
            $time = Time::parse($log['tanggal_log']);
            $agenda = [$time->getMonth(), $time->getWeekOfMonth()];
            $array_log[] = [$log['keterangan_status'], $log['tanggal_log'], $log['catatan_log'], $log['log_created_by'], $agenda, $log['status_ajuan']];
        }
        // dd($array_log);
        $data = [
            'halaman' => 'daftar_ajuan',
            'ajuan' => $ajuan,
            'status_ajuan' => $this->status_ajuanModel->where('id_status !=', 1)->findAll(),
            'array_log' => $array_log,
            'surat_tugas' => $this->surat_tugasModel->where('nomor_ajuan', $nomor_ajuan)->findAll(),
            'berita_acara' => $this->berita_acaraModel->where('nomor_ajuan', $nomor_ajuan)->findAll(),
            'bentuk_bantuan' => $this->bentukbantuanModel->findAll(),
            'dokumentasi' => $dokumentasi,
            'kuitansi' => $kuitansi,
            'data_individu' => $data_individu,
            'data_b3' => $this->formB3Model->where('nomor_ajuan', $nomor_ajuan)
                ->join('dt_kategori_penerima as ktg', 'tr_form_b3.kategori_penerima = ktg.id_kategori_penerima')
                ->join('dt_bentuk_penyerahan as s', 'tr_form_b3.bentuk_penyerahan = s.id_bentuk_penyerahan')->first()
        ];
        return view('admin/tindakan_ajuan', $data);
    }

    public function addMustahik()
    {
        $validation = \Config\Services::validation();
        $noAjuan = $this->request->getPost('ajuan_mustahik');
        $data_ajuan = $this->ajuanModel->where('nomor_ajuan', $noAjuan)->first();
        $valid = [
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

        if (!$this->validate($valid)) {
            $this->session->setFlashdata('gagal', $validation->getError('file_ktp'));
            $this->session->setFlashdata('gagal', $validation->getError('file_kk'));
        } else {
            $nik = $this->request->getPost('nik_mustahik');
            //file ktp
            if (isset($_POST['file_ktp'])) {
                $foto_ktp = $this->request->getFile('file_ktp');
                $namaFileKTP = $foto_ktp->getRandomName();
                $foto_ktp->move('file_ktp', $namaFileKTP);
            } else {
                $namaFileKTP = $this->request->getPost('nama_file_ktp_old');
            }
            // KK
            $no_kk = $this->request->getPost('no_kk');
            if (isset($_POST['file_kk'])) {
                $foto_kk = $this->request->getFile('file_kk');
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
            $this->session->setFlashdata('berhasil', "Data Mustahik individu berhasil ditambahkan");
        }
        return redirect()->to('/admin/tindakan/' . $data_ajuan['nik'] . '/' . $noAjuan);
    }

    public function editMustahik()
    {
        $validation = \Config\Services::validation();
        $id_individu = $this->request->getPost('id_individu');
        $noAjuan = $this->request->getPost('n_ajuan');
        $data_ajuan = $this->ajuanModel->where('nomor_ajuan', $noAjuan)->first();
        $valid = [
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

        if (!$this->validate($valid)) {
            $this->session->setFlashdata('gagal', $validation->getError('file_ktp'));
            $this->session->setFlashdata('gagal', $validation->getError('file_kk'));
        } else {
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
            $this->individuModel->perbarui($id_individu, $nik, $namaFileKTP, $no_kk, $namaFileKK, $nama_lengkap, $jenkel, $agama, $alamat_ktp, $provinsi, $kabupaten, $kecamatan, $kelurahan, $pendidikan, $marital, $pekerjaan, $penghasilan, $jml_keluarga, $no_handphone, $email_mustahik, $tempat_lahir, $tgl_lahir);
            $this->session->setFlashdata('berhasil', "Data Mustahik individu berhasil diedit");
        }
        return redirect()->to('/admin/tindakan/' . $data_ajuan['nik'] . '/' . $noAjuan);
    }

    public function simpan_tindakan()
    {
        if ($this->request->isAJAX()) {
            if (($this->request->getVar('status_ajuan') <= 5) && ($this->request->getVar('status_ajuan') != 0)) {
                $data_ajuan = [
                    'status_ajuan' => $this->request->getVar('status_ajuan'),
                    'edit_ajuan' => $this->request->getVar('edit_ajuan'),
                    'sifat_bantuan' => $this->request->getVar('sifat_bantuan'),
                ];
                $tanggal_log = $this->request->getVar('tanggal');
            } else if ($this->request->getVar('status_ajuan') == 0) {
                $data_ajuan = [
                    'status_ajuan' => $this->request->getVar('status_ajuan'),
                    'edit_ajuan' => $this->request->getVar('edit_ajuan'),
                    'sifat_bantuan' => $this->request->getVar('sifat_bantuan'),
                ];
                $tanggal_log = new Time('now', 'Asia/Jakarta', 'en_US');
            } else if ($this->request->getVar('status_ajuan') == 6) {
                $data_ajuan = [
                    'status_ajuan' => $this->request->getVar('status_ajuan'),
                    'edit_ajuan' => $this->request->getVar('edit_ajuan'),
                    'sifat_bantuan' => $this->request->getVar('sifat_bantuan'),
                ];
                $tanggal_log = new Time('now', 'Asia/Jakarta', 'en_US');
            } else if (($this->request->getVar('status_ajuan') == 7) || ($this->request->getVar('status_ajuan') == 8)) {
                // rubah format nilai
                $strNilaiKebutuhan = $this->request->getVar('nilai_disetujui');
                $numbNilaiKebutuhan = str_replace(".", "", $strNilaiKebutuhan);
                $data_ajuan = [
                    'status_ajuan' => $this->request->getVar('status_ajuan'),
                    'nilai_disetujui' => $numbNilaiKebutuhan,
                    'edit_ajuan' => $this->request->getVar('edit_ajuan'),
                    'sifat_bantuan' => $this->request->getVar('sifat_bantuan'),
                    'status_tersalurkan' => 'belum',

                ];
                $tanggal_log = new Time('now', 'Asia/Jakarta', 'en_US');
            } else {
                $data_ajuan = [
                    'status_ajuan' => $this->request->getVar('status_ajuan'),
                    'edit_ajuan' => $this->request->getVar('edit_ajuan'),
                    'sifat_bantuan' => $this->request->getVar('sifat_bantuan'),
                ];
                $tanggal_log = new Time('now', 'Asia/Jakarta', 'en_US');
            }

            $this->ajuanModel->transBegin();
            $this->ajuanModel->where('nomor_ajuan', $this->request->getVar('nomor_ajuan'))->set($data_ajuan)->update();
            if ($this->ajuanModel->transStatus() === false) {
                $this->ajuanModel->transRollback();
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data ajuan tidak dapat diupdate'
                    ]
                ];
            } else {
                $this->ajuanModel->transCommit();
                // simpan log
                $data_log = [
                    'nomor_ajuan' => $this->request->getVar('nomor_ajuan'),
                    'status_ajuan' => $this->request->getVar('status_ajuan'),
                    'tanggal_log' => $tanggal_log,
                    'catatan_log' => $this->request->getVar('catatan'),
                    'log_created_by' => 'Admin'
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
                            'pesan' => 'Data ajuan dan log ajuan berhasil diupdate'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function simpan_surat_tugas()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'nomor_ajuan' => $this->request->getVar('nomor_ajuan'),
                'nama_penanggung_jawab' => $this->request->getVar('nama_penanggung_jawab'),
                'jabatan' => $this->request->getVar('jabatan'),
                'berdasarkan' => $this->request->getVar('berdasarkan'),
                'agenda' => $this->request->getVar('agenda'),
                'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
                'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
                'lokasi' => $this->request->getVar('lokasi')
            ];
            $this->surat_tugasModel->transBegin();
            $this->surat_tugasModel->insert($data);
            if ($this->surat_tugasModel->transStatus() === false) {
                $this->surat_tugasModel->transRollback();
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data surat tugas tidak dapat disimpan'
                    ]
                ];
            } else {
                $this->surat_tugasModel->transCommit();
                $nama_delegasi = $this->request->getVar('nama_delegasi');
                $surat_tugas = $this->surat_tugasModel->where('nomor_ajuan', $this->request->getVar('nomor_ajuan'))
                    ->orderBy('id_surat_tugas', 'DESC')->first();
                // print_r($surat_tugas);
                // exit;
                $id_st = $surat_tugas['id_surat_tugas'];
                $this->delegasiModel->transBegin();
                foreach ($nama_delegasi as $n => $nama) {
                    $data_delegasi = [
                        'id_surat_tugas' => $id_st,
                        'nama_delegasi' => $nama
                    ];
                    $this->delegasiModel->insert($data_delegasi);
                }
                if ($this->delegasiModel->transStatus() === false) {
                    $this->delegasiModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data delegasi tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->delegasiModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Data surat tugas dan delegasi berhasil disimpan'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function lihat_surat_tugas($id_surat_tugas)
    {
        $surat_tugas = $this->surat_tugasModel->where('id_surat_tugas', $id_surat_tugas)->first();
        // nyari tanggal rapat
        $log_ajuan = $this->logajuanModel->where('nomor_ajuan', $surat_tugas['nomor_ajuan'])
            ->where('status_ajuan', 3)->first();
        if ($log_ajuan) {
            $tanggal_rapat = $log_ajuan['tanggal_log'];
        } else {
            $tanggal_rapat = "belum rapat bos";
        }
        $data = [
            'halaman' => 'daftar_ajuan',
            'surat_tugas' => $surat_tugas,
            'data_ajuan' => $this->ajuanModel->where('nomor_ajuan', $surat_tugas['nomor_ajuan'])->first(),
            'tanggal_rapat' => $tanggal_rapat,
            'nama_delegasi' => $this->delegasiModel->where('id_surat_tugas', $id_surat_tugas)->findAll()
        ];
        return view('admin/lihat_surat_tugas', $data);
    }

    public function simpan_berita_acara()
    {
        if ($this->request->isAJAX()) {
            $strNilaiKebutuhan = $this->request->getVar('nilai_penyerahan');
            $nilai_penyerahan = str_replace(".", "", $strNilaiKebutuhan);
            $data = [
                'nomor_ajuan' => $this->request->getVar('nomor_ajuan'),
                'yang_bertandatangan' => $this->request->getVar('yang_bertandatangan'),
                'tanggal_penyerahan' => $this->request->getVar('tanggal_penyerahan'),
                'lokasi_penyerahan' => $this->request->getVar('lokasi_penyerahan'),
                'berdasarkan' => $this->request->getVar('berdasarkan'),
                'bentuk_penyerahan' => $this->request->getVar('bentuk_penyerahan'),
                'nilai_penyerahan' => $nilai_penyerahan,
                'rekening_penyerahan' => $this->request->getVar('rekening_penyerahan'),
                'nama_barang' => $this->request->getVar('nama_barang'),
                'dana_dari' => $this->request->getVar('dana_dari'),
                'kategori_penerima' => $this->request->getVar('kategori_penerima'),
                'rekening_penyerahan' => $this->request->getVar('rekening_penyerahan'),
                'yang_menerima' => $this->request->getVar('yang_menerima'),
            ];
            $this->berita_acaraModel->transBegin();
            $this->berita_acaraModel->insert($data);
            if ($this->berita_acaraModel->transStatus() === false) {
                $this->berita_acaraModel->transRollback();
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data berita acara tidak dapat disimpan'
                    ]
                ];
            } else {
                $this->berita_acaraModel->transCommit();
                $msg = [
                    'berhasil' => [
                        'pesan' => 'Data berita acara berhasil disimpan'
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function lihat_berita_acara($id_berita_acara, $nomor_ajuan)
    {
        $berita_acara = $this->berita_acaraModel->where('id_berita_acara', $id_berita_acara)
            ->join('dt_kategori_penerima as ktg', 'ktg.id_kategori_penerima = ad_berita_acara.kategori_penerima')
            ->join('dt_bentuk_penyerahan as bentuk', 'bentuk.id_bentuk_penyerahan = ad_berita_acara.bentuk_penyerahan')
            ->first();
        // nyari tanggal rapat
        $log_ajuan = $this->logajuanModel->where('nomor_ajuan', $nomor_ajuan)
            ->where('status_ajuan', 3)->first();
        if ($log_ajuan) {
            $tanggal_rapat = $log_ajuan['tanggal_log'];
        } else {
            $tanggal_rapat = "belum rapat bos";
        }

        // cek ajuan lembaga/individu
        $ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)->first();
        if ($ajuan['jenis_ajuan'] == 'Individu') {
            $data_ajuan =  $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->first();
        } else {
            $data_ajuan =  $this->ajuanModel->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->first();
        }
        $data = [
            'halaman' => 'daftar_ajuan',
            'berita_acara' => $berita_acara,
            'data_ajuan' => $data_ajuan,
            'tanggal_rapat' => $tanggal_rapat
        ];
        return view('admin/lihat_berita_acara', $data);
    }

    public function daftar_pengaju()
    {
        $data = [
            'halaman' => 'daftar_pemohon',
            'data_pengaju' => $this->pemohonModel->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')->findAll()
        ];

        return view('admin/daftar_pemohon', $data);
    }

    public function detail_pemohon($nik)
    {
        $pemohon = $this->pemohonModel->where('nik', $nik)
            ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
            ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
            ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
            ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
            ->first();
        $data = [
            'halaman' => 'daftar_pemohon',
            'ajuan' => $pemohon
        ];
        return view('admin/detail_pemohon', $data);
    }

    public function edit_pemohon($nik)
    {
        $biodata = $this->pemohonModel->where('nik', $nik)->first();
        if ($biodata) {
            $pesan = "Biodata Anda sudah tersimpan, silahkan klik simpan dan melanjutkan ajuan!";
            $biodata = $biodata;
            $kabupaten = $this->kabupatenModel->where('id_provinsi', $biodata['id_provinsi'])->findAll();
            $kecamatan = $this->kecamatanModel->where('id_kabupaten', $biodata['id_kabupaten'])->findAll();
            $kelurahan = $this->kelurahanModel->where('id_kecamatan', $biodata['id_kecamatan'])->findAll();
            $status = 0;
        }
        $data = [
            'halaman' => 'daftar_pemohon',
            'biodata' => $biodata,
            'provinsi' => $this->provinsiModel->findAll(),
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
        ];
        return view('admin/edit_pemohon', $data);
    }

    public function simpan_edit_pemohon()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
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
                $nik = $this->request->getPost('nik');
                $data = [
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
                $this->pemohonModel->update($nik, $data);
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
                            'link' => "/admin/detail_pemohon/" . $nik
                        ]
                    ];
                }
            }

            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function pdf_surat_tugas($id_surat_tugas)
    {
        // Data Responden
        $surat_tugas = $this->surat_tugasModel->where('id_surat_tugas', $id_surat_tugas)->first();
        // nyari tanggal rapat
        $log_ajuan = $this->logajuanModel->where('nomor_ajuan', $surat_tugas['nomor_ajuan'])
            ->where('status_ajuan', 3)->first();
        if ($log_ajuan) {
            $tanggal_rapat = $log_ajuan['tanggal_log'];
        } else {
            $tanggal_rapat = "belum rapat bos";
        }
        $data = [
            'halaman' => 'admin',
            'surat_tugas' => $surat_tugas,
            'data_ajuan' => $this->ajuanModel->where('nomor_ajuan', $surat_tugas['nomor_ajuan'])->first(),
            'tanggal_rapat' => $tanggal_rapat,
            'nama_delegasi' => $this->delegasiModel->where('id_surat_tugas', $id_surat_tugas)->findAll()
        ];

        $html = view("/admin/pdf/surat_tugas", $data);

        $pdf = new TCPDF("P", PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Puslogin UMS');
        $pdf->SetTitle('Surat Tugas');
        $pdf->SetSubject('Berita Acara ' . $id_surat_tugas);
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
        $pdf->Output("Survey.pdf", 'I');

        //Close and output PDF document
        // $pdf->Output(__DIR__ . '/../../../public_html/lydiahidayati.com/uploads/Survey.pdf', 'F');
        // $message = "<p>Kepada Yth. </p>" . $data['nama'] . "<p>Berikut merupakan tanggapan saudara pada 
        //     Survei Revealed Preference dan Stated Preferences terhadap pilihan rantai pengangkutan (transport chain) dan ukuran pengiriman (shipment size) untuk pengiriman barang antar wilayah di Indonesia</p>";
        // $this->email2($message);

        //$this->session->destroy();
        // return redirect()->to('/admin/lihat_surat_tugas/');
    }

    public function pdf_berita_acara($id_berita_acara, $nomor_ajuan)
    {
        $berita_acara = $this->berita_acaraModel->where('id_berita_acara', $id_berita_acara)
            ->join('dt_kategori_penerima as ktg', 'ktg.id_kategori_penerima = ad_berita_acara.kategori_penerima')
            ->join('dt_bentuk_penyerahan as bentuk', 'bentuk.id_bentuk_penyerahan = ad_berita_acara.bentuk_penyerahan')
            ->first();
        // nyari tanggal rapat
        $log_ajuan = $this->logajuanModel->where('nomor_ajuan', $nomor_ajuan)
            ->where('status_ajuan', 3)->first();
        if ($log_ajuan) {
            $tanggal_rapat = $log_ajuan['tanggal_log'];
        } else {
            $tanggal_rapat = "belum rapat bos";
        }

        // cek ajuan lembaga/individu
        $ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)->first();
        if ($ajuan['jenis_ajuan'] == 'Individu') {
            $data_ajuan =  $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->first();
        } else {
            $data_ajuan =  $this->ajuanModel->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->first();
        }
        $data = [
            'halaman' => 'admin',
            'berita_acara' => $berita_acara,
            'data_ajuan' => $data_ajuan,
            'tanggal_rapat' => $tanggal_rapat,
            'terbilang' => terbilang($berita_acara['nilai_penyerahan'])
        ];

        $html = view("/admin/pdf/berita_acara", $data);

        $pdf = new TCPDF("P", PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('puslogin ums');
        $pdf->SetTitle('Berita Acara');
        $pdf->SetSubject('Berita Acara ' . $id_berita_acara);
        $pdf->SetMargins(3, 1, 3);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->addPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output("Survey.pdf", 'I');

        //Close and output PDF document
        // $pdf->Output(__DIR__ . '/../../../public_html/lydiahidayati.com/uploads/Survey.pdf', 'F');
        // $message = "<p>Kepada Yth. </p>" . $data['nama'] . "<p>Berikut merupakan tanggapan saudara pada 
        //     Survei Revealed Preference dan Stated Preferences terhadap pilihan rantai pengangkutan (transport chain) dan ukuran pengiriman (shipment size) untuk pengiriman barang antar wilayah di Indonesia</p>";
        // $this->email2($message);

        //$this->session->destroy();
        // return redirect()->to('/admin/lihat_surat_tugas/');
    }


    public function pdf_form_c1($id_berita_acara, $nomor_ajuan)
    {
        $berita_acara = $this->berita_acaraModel->where('id_berita_acara', $id_berita_acara)
            ->join('dt_kategori_penerima as ktg', 'ktg.id_kategori_penerima = ad_berita_acara.kategori_penerima')
            ->join('dt_bentuk_penyerahan as bentuk', 'bentuk.id_bentuk_penyerahan = ad_berita_acara.bentuk_penyerahan')
            ->first();
        // nyari tanggal rapat
        $log_ajuan = $this->logajuanModel->where('nomor_ajuan', $nomor_ajuan)
            ->where('status_ajuan', 3)->first();
        if ($log_ajuan) {
            $tanggal_rapat = $log_ajuan['tanggal_log'];
        } else {
            $tanggal_rapat = "belum rapat bos";
        }

        // cek ajuan lembaga/individu
        $ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)->first();
        if ($ajuan['jenis_ajuan'] == 'Individu') {
            $data_ajuan =  $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->first();
        } else {
            $data_ajuan =  $this->ajuanModel->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->first();
        }
        $data = [
            'halaman' => 'admin',
            'berita_acara' => $berita_acara,
            'data_ajuan' => $data_ajuan,
            'tanggal_rapat' => $tanggal_rapat,
            'terbilang' => terbilang($berita_acara['nilai_penyerahan'])
        ];

        $html = view("/admin/pdf/form_c1_keuangan", $data);

        $pdf = new TCPDF("P", PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('puslogin ums');
        $pdf->SetTitle('Permohonan Pencairan Dana');
        $pdf->SetSubject('Permohonan Pencairan Dana ' . $id_berita_acara);
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
        $pdf->Output("Survey.pdf", 'I');

        //Close and output PDF document
        // $pdf->Output(__DIR__ . '/../../../public_html/lydiahidayati.com/uploads/Survey.pdf', 'F');
        // $message = "<p>Kepada Yth. </p>" . $data['nama'] . "<p>Berikut merupakan tanggapan saudara pada 
        //     Survei Revealed Preference dan Stated Preferences terhadap pilihan rantai pengangkutan (transport chain) dan ukuran pengiriman (shipment size) untuk pengiriman barang antar wilayah di Indonesia</p>";
        // $this->email2($message);

        //$this->session->destroy();
        // return redirect()->to('/admin/lihat_surat_tugas/');
    }

    public function pdf_c17_kwitansi($id_berita_acara, $nomor_ajuan)
    {
        $berita_acara = $this->berita_acaraModel->where('id_berita_acara', $id_berita_acara)
            ->join('dt_kategori_penerima as ktg', 'ktg.id_kategori_penerima = ad_berita_acara.kategori_penerima')
            ->join('dt_bentuk_penyerahan as bentuk', 'bentuk.id_bentuk_penyerahan = ad_berita_acara.bentuk_penyerahan')
            ->first();
        // nyari tanggal rapat
        $log_ajuan = $this->logajuanModel->where('nomor_ajuan', $nomor_ajuan)
            ->where('status_ajuan', 3)->first();
        if ($log_ajuan) {
            $tanggal_rapat = $log_ajuan['tanggal_log'];
        } else {
            $tanggal_rapat = "belum rapat bos";
        }

        // cek ajuan lembaga/individu
        $ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)->first();
        if ($ajuan['jenis_ajuan'] == 'Individu') {
            $data_ajuan =  $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->first();
        } else {
            $data_ajuan =  $this->ajuanModel->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
                ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
                ->join('tr_lembaga', 'tr_lembaga.nomor_ajuan = tr_ajuan.nomor_ajuan')
                ->join('dt_kelurahan as kel', 'kel.id_kelurahan = tr_pemohon.id_kelurahan')
                ->join('dt_kecamatan as kec', 'kec.id_kecamatan = tr_pemohon.id_kecamatan')
                ->join('dt_kabupaten as kab', 'kab.id_kabupaten = tr_pemohon.id_kabupaten')
                ->join('dt_provinsi as prov', 'prov.id_provinsi = tr_pemohon.id_provinsi')
                ->first();
        }
        $data = [
            'halaman' => 'admin',
            'berita_acara' => $berita_acara,
            'data_ajuan' => $data_ajuan,
            'tanggal_rapat' => $tanggal_rapat,
            'terbilang' => terbilang($berita_acara['nilai_penyerahan'])
        ];

        $html = view("/admin/pdf/C17_kwitansi_pemberian", $data);

        $pdf = new TCPDF("P", PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('puslogin ums');
        $pdf->SetTitle('C17');
        $pdf->SetSubject('C17 - ' . $id_berita_acara);
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
        $pdf->Output("CI7.pdf", 'I');

        //Close and output PDF document
        // $pdf->Output(__DIR__ . '/../../../public_html/lydiahidayati.com/uploads/Survey.pdf', 'F');
        // $message = "<p>Kepada Yth. </p>" . $data['nama'] . "<p>Berikut merupakan tanggapan saudara pada 
        //     Survei Revealed Preference dan Stated Preferences terhadap pilihan rantai pengangkutan (transport chain) dan ukuran pengiriman (shipment size) untuk pengiriman barang antar wilayah di Indonesia</p>";
        // $this->email2($message);

        //$this->session->destroy();
        // return redirect()->to('/admin/lihat_surat_tugas/');
    }

    public function pdf_a17_penghimpunan($id_himpun)
    {
        $himpun = $this->penghimpunanModel->where('id_himpun', $id_himpun)
            ->join('dt_muzaki', 'tr_penghimpunan.email_muzaki = dt_muzaki.email_muzaki')
            ->join('dt_penghimpunan_ktg as ktg', 'tr_penghimpunan.ktg_himpun = ktg.id_ktg')
            ->join('dt_penghimpunan_subktg as subktg', 'tr_penghimpunan.sub_ktg_himpun = subktg.id_sub_ktg')
            ->first();


        $data = [
            'halaman' => 'admin',
            'himpun' => $himpun,
            'terbilang' => terbilang($himpun['jumlah_himpun'])
        ];

        $html = view("/admin/pdf/A17_kwitansi_himpunan", $data);

        $pdf = new TCPDF("P", PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('@purwostwn');
        $pdf->SetTitle("Kwitansi Himpunan Lazismu UMS");
        $pdf->SetSubject("Kwitansi Himpunan Lazismu UMS");
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
        $pdf->Output("Kwitansi.pdf", 'I');

        //Close and output PDF document
        // $pdf->Output(__DIR__ . '/../../../public_html/lydiahidayati.com/uploads/Survey.pdf', 'F');
        // $message = "<p>Kepada Yth. </p>" . $data['nama'] . "<p>Berikut merupakan tanggapan saudara pada 
        //     Survei Revealed Preference dan Stated Preferences terhadap pilihan rantai pengangkutan (transport chain) dan ukuran pengiriman (shipment size) untuk pengiriman barang antar wilayah di Indonesia</p>";
        // $this->email2($message);

        //$this->session->destroy();
        // return redirect()->to('/admin/lihat_surat_tugas/');
    }

    public function simpan_file_surat_tugas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = [
                'file_surat_tugas' => [
                    'label' => 'file',
                    'rules' => 'uploaded[file_surat_tugas]|max_size[file_surat_tugas,4096]|ext_in[file_surat_tugas,pdf,jpeg,jpg,png]|mime_in[file_surat_tugas,application/pdf,image/jpeg,image/jpg,image/png]',
                    'errors' => [
                        'uploaded' => 'Form tidak boleh kosong',
                        'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 4MB',
                        'ext_in' => 'Mohon maaf, semua {field} harus dalam format pdf/jpg/jpeg/png',
                        'mime_in' => 'Mohon maaf, {field} harus dalam format pdf/jpg/jpeg/png',
                    ]
                ]
            ];

            if (!$this->validate($valid)) {
                $msg = [
                    'error' => [
                        'file_surat_tugas' => $validation->getError('file_surat_tugas'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $id_surat_tugas = $this->request->getVar('id_surat_tegas');
                $formulir = $this->request->getFile('file_surat_tugas');
                $namaFormulir = $formulir->getRandomName();
                // simpan surat ket. pemohon ke directory
                $formulir->move('file_surat_tugas', $namaFormulir);

                $data = [
                    'file_surat_tugas' => $namaFormulir
                ];
                $this->surat_tugasModel->transBegin();
                $this->surat_tugasModel->update($id_surat_tugas, $data);
                if ($this->surat_tugasModel->transStatus() === false) {
                    $this->surat_tugasModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'File surat tugas tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->surat_tugasModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'File Surat Tugas berhasil disimpan'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function simpan_file_berita_acara()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = [
                'file_berita_acara' => [
                    'label' => 'file',
                    'rules' => 'uploaded[file_berita_acara]|max_size[file_berita_acara,4096]|ext_in[file_berita_acara,pdf,jpeg,jpg,png]|mime_in[file_berita_acara,application/pdf,image/jpeg,image/jpg,image/png]',
                    'errors' => [
                        'uploaded' => 'Form tidak boleh kosong',
                        'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 4MB',
                        'ext_in' => 'Mohon maaf, semua {field} harus dalam format pdf/jpg/jpeg/png',
                        'mime_in' => 'Mohon maaf, {field} harus dalam format pdf/jpg/jpeg/png',
                    ]
                ]
            ];

            if (!$this->validate($valid)) {
                $msg = [
                    'error' => [
                        'file_berita_acara' => $validation->getError('file_berita_acara'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $id_berita_acara = $this->request->getVar('id_berita_acara');
                $formulir = $this->request->getFile('file_berita_acara');
                $namaFormulir = $formulir->getRandomName();
                // simpan surat ket. pemohon ke directory
                $formulir->move('file_berita_acara', $namaFormulir);

                $data = [
                    'file_berita_acara' => $namaFormulir
                ];
                $this->berita_acaraModel->transBegin();
                $this->berita_acaraModel->update($id_berita_acara, $data);
                if ($this->berita_acaraModel->transStatus() === false) {
                    $this->berita_acaraModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'File Berita Acara tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->berita_acaraModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'File Berita Acara berhasil disimpan'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function halaman_pilar()
    {
        $data_pilar = $this->pilarModel->findAll();
        $data = [
            'halaman' => 'daftar_program',
            'data_pilar' => $data_pilar
        ];
        return view('admin/halaman_pilar', $data);
    }

    public function halaman_kategori($id_pilar)
    {
        $data_ktg = $this->kategoriProgramModel->where('id_pilar', $id_pilar)->findAll();
        $data = [
            'halaman' => 'daftar_program',
            'data_kategori' => $data_ktg,
            'id_pilar' => $id_pilar,
        ];
        return view('admin/halaman_ktg', $data);
    }

    public function simpan_edit_ktg()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kategori' => [
                    'label' => 'Nama kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'deskripsi_kategori' => [
                    'label' => 'Deskripsi kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_kategori' => [
                    'label' => 'Status kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'gagal' => [
                        'pesan' => $validation->getError('nama_kategori'),
                        'pesan' => $validation->getError('deskripsi_kategori'),
                        'pesan' => $validation->getError('status_kategori'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $id_ktg = $this->request->getPost('id_kategori_program');
                $data = [
                    'nama_kategori' => $this->request->getVar('nama_kategori'),
                    'deskripsi_kategori' => $this->request->getVar('deskripsi_kategori'),
                    'status_kategori' => $this->request->getVar('status_kategori')
                ];
                $this->kategoriProgramModel->transBegin();
                $this->kategoriProgramModel->update($id_ktg, $data);
                if ($this->kategoriProgramModel->transStatus() === false) {
                    $this->kategoriProgramModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->kategoriProgramModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Kategori program berhasil diupdate'
                        ]
                    ];
                }
            }

            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function halaman_program($id_kategori)
    {
        $data_program = $this->programModel->where('id_kategori_program', $id_kategori)->findAll();
        $data = [
            'halaman' => 'daftar_program',
            'data_program' => $data_program,
            'id_kategori' => $id_kategori
        ];
        return view('admin/halaman_program', $data);
    }

    public function simpan_edit_program()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_program' => [
                    'label' => 'Nama program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenis_formulir' => [
                    'label' => 'Jenis formulir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_program' => [
                    'label' => 'Status program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'gagal' => [
                        'pesan' => $validation->getError('nama_program'),
                        'pesan' => $validation->getError('status_program'),
                        'pesan' => $validation->getError('jenis_formulir'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $id_program = $this->request->getPost('id_program');
                $data = [
                    'nama_program' => $this->request->getVar('nama_program'),
                    'deskripsi_program' => $this->request->getVar('deskripsi_program'),
                    'jenis_formulir' => $this->request->getVar('jenis_formulir'),
                    'status_program' => $this->request->getVar('status_program')
                ];
                $this->programModel->transBegin();
                $this->programModel->update($id_program, $data);
                if ($this->programModel->transStatus() === false) {
                    $this->programModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->programModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Program berhasil diupdate'
                        ]
                    ];
                }
            }

            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function halaman_syarat($id_program)
    {
        $data_syarat = $this->syaratModel->where('id_program', $id_program)->findAll();
        $data = [
            'halaman' => 'daftar_program',
            'data_syarat' => $data_syarat,
            'id_program' => $id_program
        ];
        return view('admin/halaman_syarat', $data);
    }

    public function simpan_edit_syarat()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'syarat_program' => [
                    'label' => 'Syarat program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'gagal' => [
                        'pesan' => $validation->getError('syarat_program'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $id_syarat = $this->request->getPost('id_syarat');
                $data = [
                    'syarat_program' => $this->request->getVar('syarat_program'),
                ];
                $this->syaratModel->transBegin();
                $this->syaratModel->update($id_syarat, $data);
                if ($this->syaratModel->transStatus() === false) {
                    $this->syaratModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->syaratModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Syarat program berhasil diupdate'
                        ]
                    ];
                }
            }

            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function tambah_syarat()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'id_program' => [
                    'label' => 'Id Program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'syarat_program' => [
                    'label' => 'Syarat program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'gagal' => [
                        'pesan' => 'Pastikan form sudah terisi semua!',
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $data = [
                    'id_program' => $this->request->getVar('id_program'),
                    'syarat_program' => $this->request->getVar('syarat_program'),
                ];
                $this->syaratModel->transBegin();
                $this->syaratModel->save($data);
                if ($this->syaratModel->transStatus() === false) {
                    $this->syaratModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->syaratModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Syarat program berhasil diupdate'
                        ]
                    ];
                }
            }

            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function tambah_program()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'id_kategori' => [
                    'label' => 'Id Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama_program' => [
                    'label' => 'Nama program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'deskripsi_program' => [
                    'label' => 'Deskripsi kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenis_formulir' => [
                    'label' => 'Jenis formulir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_program' => [
                    'label' => 'Status program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'gagal' => [
                        'pesan' => 'Pastikan form sudah terisi semua!',
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $data = [
                    'id_kategori_program' => $this->request->getVar('id_kategori'),
                    'nama_program' => $this->request->getVar('nama_program'),
                    'deskripsi_program' => $this->request->getVar('deskripsi_program'),
                    'jenis_formulir' => $this->request->getVar('jenis_formulir'),
                    'status_program' => $this->request->getVar('status_program')
                ];
                $this->programModel->transBegin();
                $this->programModel->save($data);
                if ($this->programModel->transStatus() === false) {
                    $this->programModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->programModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Program berhasil disimpan'
                        ]
                    ];
                }
            }

            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function tambah_kategori()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'id_pilar' => [
                    'label' => 'Id pilar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama_kategori' => [
                    'label' => 'Nama kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'deskripsi_kategori' => [
                    'label' => 'Deskripsi kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_kategori' => [
                    'label' => 'Status kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'gagal' => [
                        'pesan' => 'Pastikan form sudah terisi semua!',
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $data = [
                    'id_pilar' => $this->request->getVar('id_pilar'),
                    'nama_kategori' => $this->request->getVar('nama_kategori'),
                    'deskripsi_kategori' => $this->request->getVar('deskripsi_kategori'),
                    'status_kategori' => $this->request->getVar('status_kategori')
                ];
                $this->kategoriProgramModel->transBegin();
                $this->kategoriProgramModel->save($data);
                if ($this->kategoriProgramModel->transStatus() === false) {
                    $this->kategoriProgramModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->kategoriProgramModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Program berhasil disimpan'
                        ]
                    ];
                }
            }

            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function hapus_program()
    {
        if ($this->request->isAJAX()) {
            $id_program = $this->request->getVar('id_program');
            $cek_ajuan  = $this->ajuanModel->where('id_program', $id_program)->countAllResults();
            if ($cek_ajuan > 0) {
                $msg = [
                    'gagal' => [
                        'pesan' => 'Program tidak bisa dihapus karena sudah digunakan. Jika program sudah tidak berlaku, Anda bisa menonaktifkan status program.'
                    ]
                ];
            } else {
                $this->programModel->transBegin();
                $this->programModel->delete($id_program);
                if ($this->programModel->transStatus() === false) {
                    $this->programModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat dihapus'
                        ]
                    ];
                } else {
                    $this->programModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Program berhasil dihapus'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function hapus_kategori()
    {
        if ($this->request->isAJAX()) {
            $id_kategori = $this->request->getVar('id_kategori');
            $cek_ajuan  = $this->ajuanModel->where('id_kategori_program', $id_kategori)->countAllResults();
            if ($cek_ajuan > 0) {
                $msg = [
                    'gagal' => [
                        'pesan' => 'Kategori tidak bisa dihapus karena sudah digunakan. Jika program sudah tidak berlaku, Anda bisa menonaktifkan status program.'
                    ]
                ];
            } else {
                $this->kategoriProgramModel->transBegin();
                $this->kategoriProgramModel->delete($id_kategori);
                if ($this->kategoriProgramModel->transStatus() === false) {
                    $this->kategoriProgramModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat dihapus'
                        ]
                    ];
                } else {
                    $this->kategoriProgramModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Program berhasil dihapus'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function hapus_syarat()
    {
        if ($this->request->isAJAX()) {
            $id_syarat = $this->request->getVar('id_syarat');
            $this->syaratModel->transBegin();
            $this->syaratModel->delete($id_syarat);
            if ($this->syaratModel->transStatus() === false) {
                $this->syaratModel->transRollback();
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data tidak dapat dihapus'
                    ]
                ];
            } else {
                $this->syaratModel->transCommit();
                $msg = [
                    'berhasil' => [
                        'pesan' => 'Syarat berhasil dihapus'
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function edit_profil()
    {
        $data = [
            'halaman' => 'edit_profil',
            'data_user' => $this->userModel->where('iduser', $this->session->get('iduser'))->first()
        ];
        return view('admin/edit_profil', $data);
    }

    public function do_edit_user()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => "required|is_unique[users.username,iduser,{iduser}]",
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah digunakan'
                ]
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 8 karakter',
                    'max_length' => '{field} maksimal 20 karakter',
                ]
            ],
            'password2' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'matches' => '{field} tidak sesuai dengan password',
                ]
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ]);

        if (!$valid) {
            $this->session->setFlashdata('errorUsername', $validation->getError('username'));
            $this->session->setFlashdata('errorPass01', $validation->getError('password'));
            $this->session->setFlashdata('errorPass02', $validation->getError('password2'));
            $this->session->setFlashdata('errorNama', $validation->getError('nama'));
            return redirect()->to("/admin/edit_profil")->withInput();
        } else {
            $iduser = $this->request->getPost('iduser');
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => sha1(strval($this->request->getPost('password2'))),
                'nama_user' => $this->request->getPost('nama')
            ];

            $this->userModel->transBegin();
            $this->userModel->update($iduser, $data);
            if ($this->userModel->transStatus() === false) {
                $this->userModel->transRollback();
                $this->session->setFlashdata('gagal', "Data user gagal disimpan!");
            } else {
                $this->userModel->transCommit();
                $this->session->setFlashdata('berhasil', "Data user berhasil disimpan, silakan Login kembali!");
            }
            return redirect()->to("/iniauth/index");
        }
    }

    public function do_edit_tersalurkan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'status_tersalurkan' => [
                    'label' => 'status tersalurkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Anda harus memilih salah satu {field}.',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'gagal' => [
                        'pesan' => $validation->getError('status_tersalurkan'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $id_ajuan = $this->request->getPost('id_ajuan');
                $data = [
                    'status_tersalurkan' => $this->request->getVar('status_tersalurkan'),
                ];
                $this->ajuanModel->transBegin();
                $this->ajuanModel->update($id_ajuan, $data);
                if ($this->ajuanModel->transStatus() === false) {
                    $this->ajuanModel->transRollback();
                    $msg = [
                        'gagal' => [
                            'pesan' => 'Data tidak dapat disimpan'
                        ]
                    ];
                } else {
                    $this->ajuanModel->transCommit();
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Status ajuan berhasil di update',
                        ]
                    ];
                }
            }

            // print_r($this->request->getVar('status'));
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function hapus_ajuan()
    {
        if ($this->request->isAJAX()) {
            $id_ajuan = $this->request->getVar('id_ajuan');
            $this->ajuanModel->transBegin();
            $this->ajuanModel->delete($id_ajuan);
            if ($this->ajuanModel->transStatus() === false) {
                $this->ajuanModel->transRollback();
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data tidak dapat dihapus',
                        'link' => "/admin/dftr_ajuan_i/"
                    ]
                ];
            } else {
                $this->ajuanModel->transCommit();
                $msg = [
                    'berhasil' => [
                        'pesan' => 'Ajuan berhasil dihapus',
                        'link' => "/admin/dftr_ajuan_i/"
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function hapus_berita_acara()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_berita_acara');
            $nik = $this->request->getVar('nik');
            $no_ajuan = $this->request->getVar('no_ajuan');
            $this->berita_acaraModel->transBegin();
            $this->berita_acaraModel->delete($id);
            if ($this->berita_acaraModel->transStatus() === false) {
                $this->berita_acaraModel->transRollback();
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data tidak dapat dihapus',
                        'link' => "/admin/tindakan/" . $nik . "/" . $no_ajuan
                    ]
                ];
            } else {
                $this->berita_acaraModel->transCommit();
                $msg = [
                    'berhasil' => [
                        'pesan' => 'Berita acara berhasil dihapus',
                        'link' => "/admin/tindakan/" . $nik . "/" . $no_ajuan
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function tolak_dokumentasi()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $jenis = $this->request->getPost('jenis');
            if ($jenis == 'nota') {
                $query = $this->kuitansiModel->edit_status($id);
            } else {
                $query = $this->dokumentasiModel->edit_status($id);
            }
            if ($query == true) {
                $msg = [
                    'berhasil' => [
                        'pesan' => 'Dokumen berhasil ditolak'
                    ]
                ];
            } else {
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data tidak dapat ditolak'
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function tambah_ctt_dokumentasi()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $jenis = $this->request->getVar('jenis');
            if ($jenis == 'nota') {
                $query = $this->kuitansiModel->tambah_catatan($id, $this->request->getPost('ctt'));
            } else {
                $query = $this->dokumentasiModel->tambah_catatan($id, $this->request->getPost('ctt'));
            }
            if ($query == true) {
                $msg = [
                    'berhasil' => [
                        'pesan' => 'Catatan berhasil ditambahkan'
                    ]
                ];
            } else {
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data tidak dapat ditambahkan'
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function v_notulensi_rapat()
    {
        $notulensi = $this->notulensiModel->findAll();
        $data = [
            'halaman' => 'notulensi_rapat',
            'notulensi' => $notulensi
        ];
        return view('/admin/notulensi_rapat', $data);
    }
    public function formulir_notulensi()
    {
        $data = [
            'halaman' => 'notulensi_rapat',
        ];
        return view('/admin/form_notulensi', $data);
    }

    public function v_penghimpunan()
    {
        $tgltime = Time::now();
        $exp = explode(' ', $tgltime);
        $exp2 = explode('-', $exp[0]);
        $bulan = $exp2[1];
        $tahun = $exp2[0];
        $data = [
            'halaman' => 'penghimpunan',
            'bln' => $bulan,
            'tahun' => $tahun
        ];
        return view('/admin/penghimpunan/tabel_penghimpunan', $data);
    }

    public function form_penghimpunan()
    {
        $muzaki = $this->muzakiModel->findAll();
        $ktg = $this->penghimpunanKtgModel->findAll();
        $data = [
            'halaman' => 'penghimpunan',
            'muzaki' => $muzaki,
            'kategori' => $ktg
        ];
        return view('/admin/penghimpunan/form_penghimpunan', $data);
    }

    public function do_edit_deskripsi()
    {
        if ($this->request->isAJAX()) {
            $idajuan = $this->request->getVar('id');
            $deskripsi = $this->request->getVar('deskripsi');
            $dt = [
                'deskripsi_ajuan' => $deskripsi
            ];
            $this->ajuanModel->transBegin();
            $this->ajuanModel->update($idajuan, $dt);
            if ($this->ajuanModel->transStatus() === false) {
                $this->ajuanModel->transRollback();
                $msg = [
                    'berhasil' => [
                        'pesan' => 'Deskripsi berhasil diedit'
                    ]
                ];
            } else {
                $this->ajuanModel->transCommit();
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data tidak dapat diupdate'
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function cetakB1individu()
    {
        $nomor_ajuan = $this->request->getVar('ajuan');
        $ajuan = $this->ajuanModel->where('tr_ajuan.nomor_ajuan', $nomor_ajuan)
            ->join('tr_pemohon', 'tr_pemohon.nik = tr_ajuan.nik')
            ->join('ad_program', 'ad_program.id_program = tr_ajuan.id_program')
            ->join('ad_kategori_program as ktg', 'ktg.id_kategori_program = tr_ajuan.id_kategori_program')
            ->join('dt_status_ajuan as sts', 'sts.id_status = tr_ajuan.status_ajuan')
            ->first();
        $data_individu = $this->individuModel->where('nomor_ajuan', $nomor_ajuan)
            ->join('dt_provinsi as prov', 'tr_individu.provinsi = prov.id_provinsi')
            ->join('dt_kabupaten as kab', 'tr_individu.kabupaten = kab.id_kabupaten')
            ->join('dt_kecamatan as kec', 'tr_individu.kecamatan = kec.id_kecamatan')
            ->join('dt_kelurahan as des', 'tr_individu.desa = des.id_kelurahan')
            ->join('dt_penghasilan as gaji', 'tr_individu.penghasilan = gaji.id_penghasilan')
            ->join('dt_pekerjaan as pekerjaan', 'tr_individu.pekerjaan = pekerjaan.id_pekerjaan')
            ->first();
        $id_program = $ajuan['id_program'];
        $syarat = $this->syaratModel->where('id_program', $id_program)->findAll();
        $data = [
            'halaman' => 'admin',
            'ajuan' => $ajuan,
            'data_individu' => $data_individu,
            'syarat' => $syarat,
            'tanggal_now' => Time::now()
        ];

        $html = view("/admin/pdf/b1_individu", $data);

        $pdf = new TCPDF("P", PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('purwo setiawan');
        $pdf->SetTitle('Form B1');
        $pdf->SetSubject('B1 ' . $nomor_ajuan);
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
        $pdf->Output("" . $nomor_ajuan . "-B1.pdf", 'I');
    }

    public function v_data_muzaki(): string
    {
        $muzaki = $this->muzakiModel->findAll();
        $data = [
            'halaman' => 'data_muzaki',
            'muzaki' => $muzaki
        ];
        return view('/admin/penghimpunan/data_muzaki', $data);
    }

    public function do_tambah_muzaki()
    {
        $validation = \Config\Services::validation();
        $valid = [
            'nama_muzaki' => [
                'label' => 'Nama Muzaki',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'email_muzaki' => [
                'label' => 'Email muzaki',
                'rules' => 'required|is_unique[dt_muzaki.email_muzaki]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => 'Gagal {field} sudah pernah digunakan'
                ]
            ]
        ];

        if (!$this->validate($valid)) {
            $this->session->setFlashdata('gagal', $validation->getError('email_muzaki'));
        } else {
            $nama_muzaki = $this->request->getPost('nama_muzaki');
            $alamat_muzaki = $this->request->getPost('alamat_muzaki');
            $tlp_muzaki = $this->request->getPost('tlp_muzaki');
            $email_muzaki = $this->request->getPost('email_muzaki');
            $jenis_muzaki = $this->request->getPost('jenis_muzaki');
            $is_dosen = $this->request->getPost('is_dosen');
            $query = $this->muzakiModel->simpan($nama_muzaki, $alamat_muzaki, $tlp_muzaki, $email_muzaki, $jenis_muzaki, $is_dosen);
            if ($query == true) {
                $this->session->setFlashdata('berhasil', 'Data muzaki berhasil tersimpan!');
            } else {
                $this->session->setFlashdata('gagal', 'GAGAL menyimpan data!');
            }
        }
        return redirect()->to('/admin/v_data_muzaki');
    }

    public function do_edit_muzaki()
    {
        $validation = \Config\Services::validation();
        $id_muzaki = $this->request->getPost('id_muzaki');
        $valid = [
            'nama_muzaki' => [
                'label' => 'Nama Muzaki',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'email_muzaki' => [
                'label' => 'Email muzaki',
                'rules' => 'required|is_unique[dt_muzaki.email_muzaki,id_muzaki,' . $id_muzaki . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => 'Gagal {field} sudah pernah digunakan'
                ]
            ]
        ];

        if (!$this->validate($valid)) {
            $this->session->setFlashdata('gagal', $validation->getError('email_muzaki'));
        } else {
            $nama_muzaki = $this->request->getPost('nama_muzaki');
            $alamat_muzaki = $this->request->getPost('alamat_muzaki');
            $tlp_muzaki = $this->request->getPost('tlp_muzaki');
            $email_muzaki = $this->request->getPost('email_muzaki');
            $jenis_muzaki = $this->request->getPost('jenis_muzaki');
            $is_dosen = $this->request->getPost('is_dosen');
            $query = $this->muzakiModel->perbarui($id_muzaki, $nama_muzaki, $alamat_muzaki, $tlp_muzaki, $email_muzaki, $jenis_muzaki, $is_dosen);
            if ($query == true) {
                $this->session->setFlashdata('berhasil', 'Data muzaki berhasil diperbarui!');
            } else {
                $this->session->setFlashdata('gagal', 'GAGAL menyimpan data!');
            }
        }
        return redirect()->to('/admin/v_data_muzaki');
    }

    public function sinkron_dosen()
    {
        $arr_tabel = [];
        $dosen_tabel = $this->muzakiModel->where('is_dosen', 1)->findAll();
        foreach ($dosen_tabel as $key => $v) {
            $arr_tabel[$v['id_muzaki']] = $v;
        }
        $arr_api = [];
        $all_api =  get_dosen_akademik();
        foreach ($all_api as $key => $v) {
            $arr_api[$v['uniid']] = $v;
        }
        $data_simpan = [];
        foreach ($arr_api as $uid => $api) {
            if (array_key_exists($uid, $arr_tabel)) {
                //update nanti rencannya
            } else {
                $data_simpan[] = [
                    'id_muzaki' => $uid,
                    'nama_muzaki' => $api['nama'],
                    'alamat_muzaki' => 'Dosen UMS',
                    'tlp_muzaki' => ' - ',
                    'email_muzaki' => $api['email'],
                    'jenis_muzaki' => '-',
                    'is_dosen' => 1
                ];
            }
        }
        if (!empty($data_simpan)) {
            $this->muzakiModel->simpanBatch($data_simpan);
        }
    }

    public function do_simpan_himpun_form()
    {

        $email_muzaki = $this->request->getPost('email_muzaki');
        $tanggal_himpun = $this->request->getPost('tanggal_himpun');
        $kategori_himpun = $this->request->getPost('kategori_himpun');
        $subktg_himpun = $this->request->getPost('subktg_himpun');
        $jumlah_himpun = $this->request->getPost('jumlah_himpun');
        $via_himpun = $this->request->getPost('via_himpun');
        $tgl_setor_bank = $this->request->getPost('tgl_setor_bank');
        $no_kwitansi_bank = $this->request->getPost('no_kwitansi_bank');
        $nama_bank = $this->request->getPost('nama_bank');

        $query = $this->penghimpunanModel->simpan($email_muzaki, $tanggal_himpun, $kategori_himpun, $subktg_himpun, $jumlah_himpun, $via_himpun, $tgl_setor_bank, $no_kwitansi_bank, $nama_bank);
        if ($query == true) {
            $this->session->setFlashdata('berhasil', 'Data penghimpunan berhasil tersimpan!');
        } else {
            $this->session->setFlashdata('gagal', 'GAGAL menyimpan data!');
        }

        return redirect()->to('/admin/v_penghimpunan');
    }

    public function excel_penghimpunan()
    {
        $file_excel = $_SERVER["DOCUMENT_ROOT"] . '/template_excel/' . 'tabel_penghimpunan.xlsx';
        $reader = IOFactory::createReader('Xlsx');
        $reader->setIncludeCharts(true);
        $spreadsheet = $reader->load($file_excel);

        $muzaki_dosen = $this->muzakiModel->where('is_dosen', 1)->findAll();

        $init_row = 7;
        foreach ($muzaki_dosen as $key => $v) {
            $spreadsheet->setActiveSheetIndexByName('PENGHIMPUNAN')
                ->setCellValue('A' . $init_row, $key + 1)
                ->setCellValue('E' . $init_row, $v['nama_muzaki'])
                ->setCellValue('F' . $init_row, $v['alamat_muzaki'])
                ->setCellValue('G' . $init_row, $v['tlp_muzaki'])
                ->setCellValue('H' . $init_row, $v['email_muzaki'])
                ->setCellValue('I' . $init_row, $v['jenis_muzaki'])
                ->setCellValue('J' . $init_row, "Penerimaan Dana Zakat")
                ->setCellValue('K' . $init_row, "Zakat Profesi");

            $init_row++;
        }

        //set border style
        $styleArray1 = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN //细边框
                ]
            ]
        ];
        $spreadsheet->setActiveSheetIndexByName('PENGHIMPUNAN')->getStyle('A7:P' . $init_row)->applyFromArray($styleArray1);
        $nama_file = "tabel_himpun_dosen";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nama_file . '.xlsx"');
        ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->setIncludeCharts(true);
        $writer->save('php://output');
        exit();
    }

    public function do_simpan_himpun_excel()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = [
                'file_excel' => [
                    'label' => 'File Excel',
                    'rules' => 'uploaded[file_excel]|max_size[file_excel,4096]|ext_in[file_excel,xlsx]',
                    'errors' => [
                        'uploaded' => '{field} tidak boleh kosong',
                        'max_size' => 'Mohon maaf, ukuran {field} tidak boleh melebihi 4MB',
                        'ext_in' => 'Mohon maaf, {field} harus dalam format .xlsx',
                        'mime_in' => 'Mohon maaf, {field} bukan .xlsx',
                    ]
                ],
            ];
            if (!$this->validate($valid)) {
                $msg = [
                    'success' => false,
                    'pesan' => $validation->getError('file_excel'),
                    'token' => csrf_hash()
                ];
            } else {
                $file_excel = $this->request->getFile('file_excel');
                $ext = $file_excel->getClientExtension();
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($file_excel);

                // validasi di dalam file excelnya (mencocokan kode)
                if (!empty($spreadsheet->getSheetByName('PENGHIMPUNAN'))) {
                    $data = $spreadsheet->setActiveSheetIndexByName("PENGHIMPUNAN")->toArray();
                    $dataSimpan = [];
                    foreach ($data as $row => $col) {
                        if ($row < 6) {
                            continue;
                        }
                        $tgl = $col[1];
                        $bulan = $col[2];
                        $tahun = $col[3];
                        $tgl_himpun = $tahun . '-' . $bulan . '-' . $tgl;
                        $kode = "B17";
                        if ($col[12] != "transfer") {
                            $kode = "A17";
                        }
                        $time = Time::now();
                        $stamps = $time->getTimestamp();
                        $explode_email = explode("@", $col[7]);
                        $id_himpun = $kode . ' - ' . $explode_email[0] . $stamps;
                        $dataSimpan[] = [
                            'id_himpun' => $id_himpun,
                            'email_muzaki' => $col[7],
                            'tanggal_himpun' => $tgl_himpun,
                            'ktg_himpun' => 1,
                            'sub_ktg_himpun' => 4,
                            'jumlah_himpun' => $col[11],
                            'via_himpun' => $col[12],
                            'tgl_setor_bank' => $col[13],
                            'kwitansi_bank' => $col[14],
                            'nm_bank' => $col[15]
                        ];
                    }

                    if (!empty($dataSimpan)) {
                        $this->penghimpunanModel->simpanBatch($dataSimpan);
                    }

                    $msg = [
                        'success' => true,
                        'pesan' => "Berhasil disimpan",
                        'token' => csrf_hash()
                    ];
                } else {
                    $msg = [
                        'success' => false,
                        'pesan' => "File excel tidak valid! Pastikan Anda mendownload dari halaman ini",
                        'token' => csrf_hash()
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            echo ("Maaf perintah anda tidak dapat diproses");
        }
    }

    public function export_penghimpunan()
    {
        $file_excel = $_SERVER["DOCUMENT_ROOT"] . '/template_excel/' . 'tabel_penghimpunan.xlsx';
        $reader = IOFactory::createReader('Xlsx');
        $reader->setIncludeCharts(true);
        $spreadsheet = $reader->load($file_excel);

        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $dt = $this->penghimpunanModel
            ->where("MONTH(tanggal_himpun)", $bulan)
            ->where("YEAR(tanggal_himpun)", $tahun)
            ->join('dt_muzaki', 'tr_penghimpunan.email_muzaki = dt_muzaki.email_muzaki')
            ->join('dt_penghimpunan_subktg as subktg', 'tr_penghimpunan.sub_ktg_himpun = subktg.id_sub_ktg')
            ->join('dt_penghimpunan_ktg as ktg', 'tr_penghimpunan.ktg_himpun = ktg.id_ktg')
            ->findAll();

        $init_row = 7;
        foreach ($dt as $key => $v) {
            $date = $v['tanggal_himpun'];
            $exp = explode('-', $date);
            $bln = $exp[1];
            $thn = $exp[0];
            $tanggal = $exp[2];
            $spreadsheet->setActiveSheetIndexByName('PENGHIMPUNAN')
                ->setCellValue('A' . $init_row, $key + 1)
                ->setCellValue('B' . $init_row, $tanggal)
                ->setCellValue('C' . $init_row, $bln)
                ->setCellValue('D' . $init_row, $thn)
                ->setCellValue('E' . $init_row, $v['nama_muzaki'])
                ->setCellValue('F' . $init_row, $v['alamat_muzaki'])
                ->setCellValue('G' . $init_row, $v['tlp_muzaki'])
                ->setCellValue('H' . $init_row, $v['email_muzaki'])
                ->setCellValue('I' . $init_row, $v['jenis_muzaki'])
                ->setCellValue('J' . $init_row, $v['keterangan_ktg'])
                ->setCellValue('K' . $init_row, $v['keterangan_sub'])
                ->setCellValue('L' . $init_row, $v['jumlah_himpun'])
                ->setCellValue('M' . $init_row, $v['via_himpun'])
                ->setCellValue('N' . $init_row, $v['tgl_setor_bank'])
                ->setCellValue('O' . $init_row, $v['kwitansi_bank'])
                ->setCellValue('P' . $init_row, $v['nm_bank']);

            $init_row++;
        }

        //set border style
        $styleArray1 = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN //细边框
                ]
            ]
        ];
        $spreadsheet->setActiveSheetIndexByName('PENGHIMPUNAN')->getStyle('A7:P' . $init_row)->applyFromArray($styleArray1);
        $nama_file = "Pengimpunan " . $tahun . "_" . $bulan;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nama_file . '.xlsx"');
        ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->setIncludeCharts(true);
        $writer->save('php://output');
        exit();
    }

    public function do_edit_penghimpunan()
    {
        $id_himpun = $this->request->getPost('id_himpun');
        $jumlah_himpun = $this->request->getPost('jumlah_himpun');
        $tgl_setor_bank = $this->request->getPost('tgl_setor_bank');
        $kwitansi_bank = $this->request->getPost('kwitansi_bank');
        $nama_bank = $this->request->getPost('nama_bank');

        $dt = [
            "jumlah_himpun" => $jumlah_himpun,
            "tgl_setor_bank" => $tgl_setor_bank,
            "kwitansi_bank" => $kwitansi_bank,
            "nm_bank" => $nama_bank
        ];


        $this->penghimpunanModel->transBegin();
        $this->penghimpunanModel->update($id_himpun, $dt);
        if ($this->penghimpunanModel->transStatus() === false) {
            $this->penghimpunanModel->transRollback();
            $this->session->setFlashdata('gagal', 'GAGAL menyimpan data!');
        } else {
            $this->penghimpunanModel->transCommit();
            $this->session->setFlashdata('berhasil', 'Data penghimpunan berhasil diperbarui!');
        }
        return redirect()->to('/admin/v_penghimpunan');
    }

    public function do_hapus_penghimpunan()
    {
        if (isset($_POST['id'])) {
            $id = $this->request->getPost('id');
            $hapus = $this->penghimpunanModel->hapus($id);
            if ($hapus == false) {
                $status = 'gagal';
                $pesan = 'Data penghimpunan gagal dihapus!';
            } else {
                $status = 'berhasil';
                $pesan = 'Data penghimpunan berhasil dihapus!';
            }
            $msg = [
                'status' => $status,
                'pesan' => $pesan
            ];
            echo json_encode($msg);
        }
    }

    public function do_simpan_b3()
    {
        $nomor_ajuan = $this->request->getVar('nomor_ajuan');
        $dana_dari = $this->request->getPost('dana_dari');
        $kategori_penerima = $this->request->getPost('kategori_penerima');
        $bentuk_penyerahan = $this->request->getPost('bentuk_penyerahan');
        $data_ajuan = $this->ajuanModel->where('nomor_ajuan', $nomor_ajuan)->first();

        $cek = $this->formB3Model->where('nomor_ajuan', $nomor_ajuan)->first();
        if (empty($cek)) {
            $this->formB3Model->simpan($nomor_ajuan, $dana_dari, $kategori_penerima, $bentuk_penyerahan);
            $this->session->setFlashdata('berhasil', "Data B3 berhasil disimpan!");
        } else {
            $this->formB3Model->edit($nomor_ajuan, $dana_dari, $kategori_penerima, $bentuk_penyerahan);
            $this->session->setFlashdata('berhasil', "Data B3 berhasil diperbarui!");
        }

        return redirect()->to('/admin/tindakan/' . $data_ajuan['nik'] . '/' . $nomor_ajuan);
    }

    public function simpan_init_notulensi()
    {
        if (isset($_POST['tgl_rapat'])) {
            $tgl_rapat = $this->request->getPost('tgl_rapat');
            $jam_mulai = $this->request->getPost('jam_mulai');
            $pemimpin_rapat = $this->request->getPost('pemimpin_rapat');
            $simpan = $this->notulensiModel->simpan($tgl_rapat, $jam_mulai, $pemimpin_rapat);
            if ($simpan == false) {
                $this->session->setFlashdata('gagal', 'Data notulensi gagal tersimpan!');
                return redirect()->to('/admin/formulir_notulensi')->withInput();
            } else {
                $this->session->setFlashdata('berhasil', 'Data notulensi berhasil tersimpan!');
                return redirect()->to('/admin/detail_notulensi?idnotulensi=' . $simpan)->withInput();
            }
        }
    }

    public function detail_notulensi()
    {
        $idnotulensi = $this->request->getVar('idnotulensi');
        $r_notulensi = $this->notulensiModel->where('id', $idnotulensi)->first();
        $time = Time::parse($r_notulensi['tgl_rapat']);
        $tanggal_mulai = $time->toLocalizedString('d MMM yyyy');
        $nama_hari = getNamaHari($time);
        $agenda_notulensi = $this->notulensiAgendaModel->where('idnotulensi', $idnotulensi)->findAll();
        $data = [
            'halaman' => 'notulensi_rapat',
            'r_notulensi' => $r_notulensi,
            'tgl_mulai' => $tanggal_mulai,
            'nama_hari' => $nama_hari,
            'agenda' => $agenda_notulensi
        ];
        return view('/admin/detail_notulensi', $data);
    }

    public function do_simpan_agenda()
    {
        $idnotulensi = intval($this->request->getVar('idnotulensi'));
        $nama_agenda = $this->request->getVar('nama_agenda');
        $catatan_agenda = $this->request->getVar('catatan_agenda');

        $simpan = $this->notulensiAgendaModel->simpan($idnotulensi, $nama_agenda, $catatan_agenda);
        if ($simpan == false) {
            $this->session->setFlashdata('gagal', "Gagal simpan agenda rapat!");
        } else {
            $this->session->setFlashdata('berhasil', "Berhasil simpan agenda rapat!");
        }
        return redirect()->to('/admin/detail_notulensi?idnotulensi=' . $idnotulensi);
    }

    public function hapus_agenda_notulensi()
    {
        if (isset($_POST['idagenda'])) {
            $idagenda = $this->request->getPost('idagenda');
            $hapus = $this->notulensiAgendaModel->hapus($idagenda);
            if ($hapus == false) {
                $status = 'gagal';
                $pesan = 'Data agenda gagal dihapus!';
            } else {
                $status = 'berhasil';
                $pesan = 'Data agenda berhasil dihapus!';
            }
            $msg = [
                'status' => $status,
                'pesan' => $pesan
            ];
            echo json_encode($msg);
        }
    }

    public function do_simpan_edit_agenda()
    {
        $idnotulensi = intval($this->request->getVar('idnotulensi'));
        $idagenda = intval($this->request->getVar('idagenda'));
        $nama_agenda = $this->request->getVar('nama_agenda');
        $catatan_agenda = $this->request->getVar('catatan_agenda');

        $simpan = $this->notulensiAgendaModel->edit($idagenda, $nama_agenda, $catatan_agenda);
        if ($simpan == false) {
            $this->session->setFlashdata('gagal', "Gagal simpan agenda rapat!");
        } else {
            $this->session->setFlashdata('berhasil', "Berhasil edit agenda rapat!");
        }
        return redirect()->to('/admin/detail_notulensi?idnotulensi=' . $idnotulensi);
    }

    public function do_simpan_update_notulensi()
    {
        $idnotulensi = intval($this->request->getPost('idnotulensi'));
        $jam_selesai = $this->request->getPost('jam_selesai');
        $notulen = $this->request->getPost('notulen');
        $catatan_notulensi = $this->request->getPost('catatan_notulensi');

        $simpan = $this->notulensiModel->edit($idnotulensi, $jam_selesai, $notulen, $catatan_notulensi);
        if ($simpan == false) {
            $this->session->setFlashdata('gagal', "Gagal simpan notulensi rapat!");
        } else {
            $this->session->setFlashdata('berhasil', "Berhasil edit notulensi rapat!");
        }
        return redirect()->to('/admin/detail_notulensi?idnotulensi=' . $idnotulensi);
    }

    public function hapus_ajuan_notulensi()
    {
        if (isset($_POST['idajuan'])) {
            $id = $this->request->getPost('idajuan');
            $hapus = $this->notulensiAjaunModel->hapus($id);
            if ($hapus == false) {
                $status = 'gagal';
                $pesan = 'Data ajuan gagal dihapus!';
            } else {
                $status = 'berhasil';
                $pesan = 'Data ajuan berhasil dihapus!';
            }
            $msg = [
                'status' => $status,
                'pesan' => $pesan
            ];
            echo json_encode($msg);
        }
    }

    public function hapus_notulensi()
    {
        if (isset($_POST['id'])) {
            $id = $this->request->getPost('id');
            $hapusAjuanNotulensi = $this->notulensiAjaunModel->where('idnotulensi', $id)->delete();
            $hapusAgendaNotulensi = $this->notulensiAgendaModel->where('idnotulensi', $id)->delete();
            $hapus = $this->notulensiModel->hapus($id);
            if ($hapus == false) {
                $status = 'gagal';
                $pesan = 'Data notulensi gagal dihapus!';
            } else {
                $status = 'berhasil';
                $pesan = 'Data notulensi berhasil dihapus!';
            }
            $msg = [
                'status' => $status,
                'pesan' => $pesan
            ];
            echo json_encode($msg);
        }
    }
}
