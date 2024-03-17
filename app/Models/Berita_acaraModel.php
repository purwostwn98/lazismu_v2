<?php

namespace App\Models;

use CodeIgniter\Model;

class Berita_acaraModel extends Model
{
    protected $table      = 'ad_berita_acara';
    protected $primaryKey = 'id_berita_acara';
    protected $allowedFields = [
        'nomor_ajuan', 'yang_bertandatangan', 'tanggal_penyerahan', 'lokasi_penyerahan',
        'berdasarkan', 'bentuk_penyerahan', 'nilai_penyerahan', 'rekening_penyerahan',
        'nama_barang', 'dana_dari', 'kategori_penerima', 'yang_menerima', 'file_berita_acara'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'ba_created_at';
    protected $updatedField  = 'ba_updated_at';
}

class BentukpenyerahanModel extends Model
{
    protected $table        = 'dt_bentuk_penyerahan';
    protected $primaryKey   = 'id_bentuk_penyerahan';
}

class KategoripenerimaModel extends Model
{
    protected $table        = 'dt_kategori_penerima';
    protected $primaryKey   = 'id_kategori_penerima';
}
