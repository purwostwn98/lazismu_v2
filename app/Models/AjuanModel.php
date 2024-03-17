<?php

namespace App\Models;

use CodeIgniter\Model;

class AjuanModel extends Model
{
    protected $table      = 'tr_ajuan';
    protected $primaryKey = 'id_ajuan';
    protected $allowedFields = [
        'nomor_ajuan', 'nik', 'id_kategori_program', 'id_program', 'nilai_diajukan', 'deskripsi_ajuan', 'jenis_ajuan', 'file_formulir', 'file_proposal', 'status_ajuan',
        'status_tersalurkan', 'tgl_diajukan', 'nilai_disetujui', 'sifat_bantuan', 'edit_ajuan', 'last_updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'tgl_diajukan';
    protected $updatedField  = 'last_updated_at';
}

class LembagaModel extends Model
{
    protected $table      = 'tr_lembaga';
    protected $primaryKey = 'id_lembaga';
    protected $allowedFields = [
        'nomor_ajuan', 'nama_lembaga', 'alamat_lembaga', 'nomor_lembaga'
    ];
}

class IndividuModel extends Model
{
    protected $table      = 'tr_individu';
    protected $primaryKey = 'id_individu';
    protected $allowedFields = [
        'nomor_ajuan', 'nik', 'foto_ktp', 'kk', 'foto_kk', 'nama_mustahik', 'kelamin_mustahik', 'agama_mustahik', 'alamat', 'provinsi', 'kabupaten', 'kecamatan', 'desa', 'status_pendidikan', 'status_marital', 'pekerjaan', 'penghasilan', 'jml_keluarga',  'no_handphone', 'email', 'tempat_lahir', 'tgl_lahir', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function simpan(
        $nomor_ajuan,
        $nik,
        $foto_ktp,
        $kk,
        $foto_kk,
        $nama_mustahik,
        $kelamin_mustahik,
        $agama_mustahik,
        $alamat,
        $provinsi,
        $kabupaten,
        $kecamatan,
        $desa,
        $status_pendidikan,
        $status_marital,
        $pekerjaan,
        $penghasilan,
        $jml_keluarga,
        $no_handphone,
        $email,
        $tempat_lahir,
        $tgl_lahir
    ) {
        $dt = [
            'nomor_ajuan' => $nomor_ajuan,
            'nik' => $nik,
            'foto_ktp' => $foto_ktp,
            'kk' => $kk,
            'foto_kk' => $foto_kk,
            'nama_mustahik' => $nama_mustahik,
            'kelamin_mustahik' => $kelamin_mustahik,
            'agama_mustahik' => $agama_mustahik,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'status_pendidikan' => $status_pendidikan,
            'status_marital' => $status_marital,
            'pekerjaan' => $pekerjaan,
            'penghasilan' => $penghasilan,
            'jml_keluarga' => $jml_keluarga,
            'no_handphone' => $no_handphone,
            'email' => $email,
            'tempat_lahir' => $tempat_lahir,
            'tgl_lahir' => $tgl_lahir
        ];

        $this->transBegin();
        $this->insert($dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = [
                'gagal' => [
                    'pesan' => 'Data mustahik gagal disimpan'
                ]
            ];
        } else {
            $this->transCommit();
            $msg = [
                'berhasil' => [
                    'pesan' => 'Data mustahik berhasil disimpan'
                ]
            ];
        }
        return $msg;
    }

    public function perbarui(
        $id,
        $nik,
        $foto_ktp,
        $kk,
        $foto_kk,
        $nama_mustahik,
        $kelamin_mustahik,
        $agama_mustahik,
        $alamat,
        $provinsi,
        $kabupaten,
        $kecamatan,
        $desa,
        $status_pendidikan,
        $status_marital,
        $pekerjaan,
        $penghasilan,
        $jml_keluarga,
        $no_handphone,
        $email,
        $tempat_lahir,
        $tgl_lahir
    ) {
        $dt = [
            'nik' => $nik,
            'foto_ktp' => $foto_ktp,
            'kk' => $kk,
            'foto_kk' => $foto_kk,
            'nama_mustahik' => $nama_mustahik,
            'kelamin_mustahik' => $kelamin_mustahik,
            'agama_mustahik' => $agama_mustahik,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'status_pendidikan' => $status_pendidikan,
            'status_marital' => $status_marital,
            'pekerjaan' => $pekerjaan,
            'penghasilan' => $penghasilan,
            'jml_keluarga' => $jml_keluarga,
            'no_handphone' => $no_handphone,
            'email' => $email,
            'tempat_lahir' => $tempat_lahir,
            'tgl_lahir' => $tgl_lahir
        ];

        $this->transBegin();
        $this->update($id, $dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = [
                'gagal' => [
                    'pesan' => 'Data mustahik gagal diedit'
                ]
            ];
        } else {
            $this->transCommit();
            $msg = [
                'berhasil' => [
                    'pesan' => 'Data mustahik berhasil diedit'
                ]
            ];
        }
        return $msg;
    }
}

class StsajuanModel extends Model
{
    protected $table      = 'dt_status_ajuan';
    protected $primaryKey = 'id_status';
}

class LogajuanModel extends Model
{
    protected $table      = 'ad_log_ajuan';
    protected $primaryKey = 'id_log_ajuan';
    protected $allowedFields = [
        'nomor_ajuan', 'status_ajuan', 'tanggal_log', 'catatan_log', 'log_created_at', 'log_updated_at', 'log_created_by'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'log_created_at';
    protected $updatedField  = 'log_updated_at';
}

class DokumentasiModel extends Model
{
    protected $table      = 'tr_dokumentasi';
    protected $primaryKey = 'id_dokumentasi';
    protected $allowedFields = [
        'no_ajuan', 'nama_file', 'status', 'catatan', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function simpan($no_ajuan, $nama_file, $status, $catatan = "")
    {
        $dt = [
            'no_ajuan' => $no_ajuan, 'nama_file' => $nama_file, 'status' => $status, 'catatan' => $catatan
        ];
        $this->transBegin();
        $this->insert($dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = [
                'gagal' => [
                    'pesan' => 'File Dokumentasi tidak dapat disimpan'
                ]
            ];
        } else {
            $this->transCommit();
            $msg = [
                'berhasil' => [
                    'pesan' => 'File Dokumentasi berhasil disimpan'
                ]
            ];
        }
        return $msg;
    }

    function edit_status($id_dokumentasi, $status = "ditolak")
    {
        $dt = [
            'status' => $status
        ];
        $this->transBegin();
        $this->update($id_dokumentasi, $dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            return false;
        } else {
            $this->transCommit();
            return true;
        }
    }

    function tambah_catatan($id_dokumentasi, $catatan = "")
    {
        $dt = [
            'catatan' => $catatan
        ];
        $this->transBegin();
        $this->update($id_dokumentasi, $dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            return false;
        } else {
            $this->transCommit();
            return true;
        }
    }
}

class KuitansiModel extends Model
{
    protected $table      = 'tr_kuitansi';
    protected $primaryKey = 'id_kuitansi';
    protected $allowedFields = [
        'no_ajuan', 'nama', 'status', 'catatan', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function simpan($no_ajuan, $nama_file, $status, $catatan = "")
    {
        $dt = [
            'no_ajuan' => $no_ajuan, 'nama' => $nama_file, 'status' => $status, 'catatan' => $catatan
        ];
        $this->transBegin();
        $this->insert($dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = [
                'gagal' => [
                    'pesan' => 'File kuitansi tidak dapat disimpan'
                ]
            ];
        } else {
            $this->transCommit();
            $msg = [
                'berhasil' => [
                    'pesan' => 'File kuitansi berhasil disimpan'
                ]
            ];
        }
        return $msg;
    }

    function edit_status($id_kuitansi, $status = "ditolak")
    {
        $dt = [
            'status' => $status
        ];
        $this->transBegin();
        $this->update($id_kuitansi, $dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            return false;
        } else {
            $this->transCommit();
            return true;
        }
    }

    function tambah_catatan($id_kuitansi, $catatan = "")
    {
        $dt = [
            'catatan' => $catatan
        ];
        $this->transBegin();
        $this->update($id_kuitansi, $dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            return false;
        } else {
            $this->transCommit();
            return true;
        }
    }
}
