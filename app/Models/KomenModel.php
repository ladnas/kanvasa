<?php

namespace App\Models;

use CodeIgniter\Model;

class KomenModel extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';
    protected $allowedFields = ['foto_id', 'user_id', 'isi_komentar', 'tgl_komentar'];


    // Tambahkan fungsi-fungsi lainnya sesuai kebutuhan
    public function getKomentarByFotoId($foto_id)
    {
        return $this->where('foto_id', $foto_id)->findAll();
    }

    public function getKomentarWithUsername($foto_id)
    {
        return $this->select('komentar.*, user.username, user.foto_profil')
            ->join('user', 'user.user_id = komentar.user_id')
            ->where('komentar.foto_id', $foto_id)
            ->findAll();
    }

    public function getTotalKomentar($foto_id)
    {
        return $this->where('foto_id', $foto_id)->countAllResults();
    }
}
