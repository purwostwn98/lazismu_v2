<?php

namespace App\Models;

use CodeIgniter\Model;

class NotulensiModel extends Model
{
    protected $table      = 'tr_notulensi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tgl_rapat', 'jam_mulai', 'jam_selesai', 'catatan_rapat', 'pemimpin_rapat', 'notulen'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function simpan($tgl_rapat, $jam_mulai, $pemimpin_rapat, $jam_selesai = null, $catatan_rapat = null, $notulen = null)
    {
        $dt = [
            'tgl_rapat' => $tgl_rapat, 'jam_mulai' => $jam_mulai, 'jam_selesai' => $jam_selesai, 'catatan_rapat' => $catatan_rapat, 'pemimpin_rapat' => $pemimpin_rapat, 'notulen' => $notulen
        ];

        $this->transBegin();
        $this->insert($dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = $this->getInsertID();
        }
        return $msg;
    }

    public function edit($idnotulensi, $jam_selesai, $notulen, $catatan_rapat)
    {

        $dt = [
            'jam_selesai' => $jam_selesai, 'catatan_rapat' => $catatan_rapat, 'notulen' => $notulen
        ];

        $this->transBegin();
        $this->update($idnotulensi, $dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = $idnotulensi;
        }
        return $msg;
    }
}

class NotulensiAjuanModel extends Model
{
    protected $table      = 'tr_notulensi_ajuan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'idnotulensi', 'nomor_ajuan'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function simpan($idnotulensi, $nomor_ajuan)
    {
        $dt = [
            'idnotulensi' => $idnotulensi, 'nomor_ajuan' => $nomor_ajuan
        ];

        $this->transBegin();
        $this->insert($dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = $this->getInsertID();
        }
        return $msg;
    }
}

class NotulensiAgendaModel extends Model
{
    protected $table      = 'tr_notulensi_agenda';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_agenda', 'catatan_agenda', 'idnotulensi'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function simpan($idnotulensi, $nama_agenda, $catatan_agenda)
    {
        $dt = [
            'idnotulensi' => $idnotulensi, 'nama_agenda' => $nama_agenda, 'catatan_agenda' => $catatan_agenda
        ];

        $this->transBegin();
        $this->insert($dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = $this->getInsertID();
        }
        return $msg;
    }

    public function edit($idagenda, $nama_agenda, $catatan_agenda)
    {
        $dt = [
            'nama_agenda' => $nama_agenda, 'catatan_agenda' => $catatan_agenda
        ];

        $this->transBegin();
        $this->update($idagenda, $dt);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = $idagenda;
        }
        return $msg;
    }
}
