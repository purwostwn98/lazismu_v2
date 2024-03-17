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
}
