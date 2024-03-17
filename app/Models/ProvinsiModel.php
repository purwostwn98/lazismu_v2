<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table      = 'dt_provinsi';
    protected $primaryKey = 'id_provinsi';
}

class KabupatenModel extends Model
{
    protected $table      = 'dt_kabupaten';
    protected $primaryKey = 'id_kabupaten';
}

class KecamatanModel extends Model
{
    protected $table      = 'dt_kecamatan';
    protected $primaryKey = 'id_kecamatan';
}

class KelurahanModel extends Model
{
    protected $table      = 'dt_kelurahan';
    protected $primaryKey = 'id_kelurahan';
}
