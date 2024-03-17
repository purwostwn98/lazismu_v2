<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table      = 'ad_program';
    protected $primaryKey = 'id_program';
    protected $allowedFields = [
        'id_kategori_program', 'nama_program', 'deskripsi_program', 'jenis_formulir',  'status_program'
    ];
}

class PilarModel extends Model
{
    protected $table      = 'dt_pilar';
    protected $primaryKey = 'id_pilar';
}

class KategoriModel extends Model
{
    protected $table      = 'ad_kategori_program';
    protected $primaryKey = 'id_kategori_program';
    protected $allowedFields = [
        'id_pilar', 'nama_kategori', 'deskripsi_kategori', 'status_kategori'
    ];
}

class SyaratModel extends Model
{
    protected $table      = 'ad_syarat_program';
    protected $primaryKey = 'id_syarat';
    protected $allowedFields = [
        'id_program', 'syarat_program'
    ];
}
