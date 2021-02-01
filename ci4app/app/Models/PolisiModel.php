<?php

namespace App\Models;

use CodeIgniter\Model;

class PolisiModel extends Model
{
    protected $table = 'polisi';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_Anggota', 'slug', 'pangkat', 'jabatan', 'foto'];


    public function getpolisi($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
}
