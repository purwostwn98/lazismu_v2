<?php

namespace App\Models;

use CodeIgniter\Model;

class MuzakiModel extends Model
{
    protected $table      = 'dt_muzaki';
    protected $primaryKey = 'id_muzaki';
    protected $allowedFields = [
        'id_muzaki', 'nama_muzaki', 'alamat_muzaki', 'tlp_muzaki',
        'email_muzaki', 'jenis_muzaki', 'is_dosen'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'mzk_crat';
    protected $updatedField  = 'mzk_uat';

    public function simpanBatch($arr_data)
    {
        return $this->insertBatch($arr_data);
    }

    public function simpan($nama_muzaki, $alamat_muzaki, $tlp_muzaki, $email_muzaki, $jenis_muzaki, $is_dosen = 0)
    {
        $id = "mzi-";
        $firstString = getFirstLetters($nama_muzaki);
        $randomNumber = getRandomNumber001_009();
        $id .= strtolower($firstString) . $randomNumber;
        $cek_key = $this->where('id_muzaki', $id)->countAllResults();
        while ($cek_key > 0) {
            $randomNumber = getRandomNumber001_009();
            $id = "mzi-" . $firstString . $randomNumber;
            $cek_key = $this->where('id_muzaki', $id)->countAllResults();
        }

        $dt = [
            'id_muzaki' => $id,
            'nama_muzaki' => $nama_muzaki,
            'alamat_muzaki' => $alamat_muzaki,
            'tlp_muzaki' => $tlp_muzaki,
            'email_muzaki' => $email_muzaki,
            'jenis_muzaki' => $jenis_muzaki,
            'is_dosen' => $is_dosen
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

    public function perbarui($id_muzaki, $nama_muzaki, $alamat_muzaki, $tlp_muzaki, $email_muzaki, $jenis_muzaki, $is_dosen)
    {

        $dt = [
            'id_muzaki' => $id_muzaki,
            'nama_muzaki' => $nama_muzaki,
            'alamat_muzaki' => $alamat_muzaki,
            'tlp_muzaki' => $tlp_muzaki,
            'email_muzaki' => $email_muzaki,
            'jenis_muzaki' => $jenis_muzaki,
            'is_dosen' => $is_dosen
        ];

        $this->transBegin();
        $this->update($id_muzaki, $dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = 0;
        } else {
            $this->transCommit();
            $msg = 1;
        }
        return $msg;
    }
}
