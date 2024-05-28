<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class PenghimpunanModel extends Model
{
    protected $table      = 'tr_penghimpunan';
    protected $primaryKey = 'id_himpun';
    protected $allowedFields = [
        'id_himpun', 'email_muzaki', 'tanggal_himpun', 'ktg_himpun',
        'sub_ktg_himpun', 'jumlah_himpun', 'via_himpun', 'tgl_setor_bank',
        'kwitansi_bank', 'nm_bank'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'himpun_crat';
    protected $updatedField  = 'himpun_upat';

    public function simpan(
        $email_muzaki,
        $tanggal_himpun,
        $ktg_himpun,
        $sub_ktg_himpun,
        $jumlah_himpun,
        $via_himpun,
        $tgl_setor_bank,
        $kwitansi_bank,
        $nm_bank
    ) {
        if ($via_himpun == 'transfer') {
            $kode = "B17";
        } else {
            $kode = "A17";
        }
        $timenow = Time::now();
        $timestamp = $timenow->getTimestamp();
        $firstThreeCharacters = strtoupper(substr($email_muzaki, 0, 3));
        $id_himpun = $kode . "-" . $firstThreeCharacters . $timestamp;
        $dt = [
            'id_himpun' => $id_himpun,
            'email_muzaki' => $email_muzaki,
            'tanggal_himpun' => $tanggal_himpun,
            'ktg_himpun' => $ktg_himpun,
            'sub_ktg_himpun' => $sub_ktg_himpun,
            'jumlah_himpun' => $jumlah_himpun,
            'via_himpun' => $via_himpun,
            'tgl_setor_bank' => $tgl_setor_bank,
            'kwitansi_bank' => $kwitansi_bank,
            'nm_bank' => $nm_bank
        ];

        $this->transBegin();
        $this->insert($dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = true;
        }
        return $msg;
    }

    public function simpanBatch($array_data)
    {
        $this->transBegin();
        $this->insertBatch($array_data);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = true;
        }
        return $msg;
    }

    public function hapus($id)
    {
        $this->transBegin();
        $this->delete($id);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = true;
        }
        return $msg;
    }
}

class PenghimpunanKtgModel extends Model
{
    protected $table      = 'dt_penghimpunan_ktg';
    protected $primaryKey = 'id_ktg';
}
class PenghimpunanSubktgModel extends Model
{
    protected $table      = 'dt_penghimpunan_subktg';
    protected $primaryKey = 'id_sub_ktg';
}
