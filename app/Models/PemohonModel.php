<?php

namespace App\Models;

use CodeIgniter\Model;

class PemohonModel extends Model
{
    protected $table      = 'tr_pemohon';
    protected $primaryKey = 'nik';
    protected $allowedFields = [
        'nik', 'nama_pemohon', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'id_provinsi', 'id_kabupaten', 'id_kecamatan', 'id_kelurahan',
        'alamat_detail', 'agama', 'telepon', 'email', 'pemohon_created_at', 'pemohon_updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'pemohon_created_at';
    protected $updatedField  = 'pemohon_updated_at';
}

class PrivModel extends Model
{
    protected $table = 'privuser';
}
