<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table      = 'dt_pekerjaan';
    protected $primaryKey = 'id_pekerjaan';
    protected $allowedFields = [
        'nama_pekerjaan'
    ];
}

class PenghasilanModel extends Model
{
    protected $table      = 'dt_penghasilan';
    protected $primaryKey = 'id_penghasilan';
    protected $allowedFields = [
        'label_penghasilan'
    ];
}
