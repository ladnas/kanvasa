<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = 'likefoto';
    protected $primaryKey = 'like_id';
    protected $allowedFields = ['foto_id', 'user_id', 'tgl_like', 'type'];
    protected $useTimestamps = false; // Jika tidak menggunakan kolom timestamp pada tabel

    public function isLiked($foto_id, $user_id)
    {
        return $this->where(['foto_id' => $foto_id, 'user_id' => $user_id, 'type' => 'like'])->countAllResults() > 0;
    }

    public function isDisliked($foto_id, $user_id)
    {
        return $this->where(['foto_id' => $foto_id, 'user_id' => $user_id, 'type' => 'dislike'])->countAllResults() > 0;
    }

    public function getTotalLike($foto_id)
    {
        return $this->where(['foto_id' => $foto_id, 'type' => 'like'])->countAllResults();
    }

    public function getTotalDislike($foto_id)
    {
        return $this->where(['foto_id' => $foto_id, 'type' => 'dislike'])->countAllResults();
    }

    public function deleteLike($foto_id, $user_id)
    {
        return $this->where(['foto_id' => $foto_id, 'user_id' => $user_id])->delete();
    }
}


