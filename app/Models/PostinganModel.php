<?php

namespace App\Models;

use CodeIgniter\Model;

class PostinganModel extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'foto_id';
    protected $allowedFields = ['foto_id', 'judul_foto', 'desk_foto', 'tgl_unggah', 'lokasi_file', 'album_id', 'id_user'];

    public function users()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'user_id');
    }

    public function getFotoWithUsername()
    {
        return $this->select('foto.*, user.username AS nama_user, user.foto_profil')
            ->join('user', 'user_id = foto.id_user')
            ->get()
            ->getResult();
    }

    public function user($foto_id)
    {
        return $this->join('user', 'user.user_id = foto.id_user')
            ->select('user.username, user.foto_profil')
            ->where('foto.foto_id', $foto_id)
            ->get()
            ->getRow();
    }

    public function getPostByUserId($user_id)
    {
        return $this->where('id_user', $user_id)
            ->findAll();
    }

    public function updatePost($foto_id, $data)
    {
        return $this->update($foto_id, $data);
    }
    // Your existing methods here...
    public function getFotoById($foto_id)
    {
        return $this->find($foto_id);
    }

    public function postingan()
    {
        return $this->select('*')
            ->findAll();
    }

    public function searchPosts($keyword)
{
    return $this->select('foto.*, user.foto_profil, user.username AS nama_user')
                ->join('user', 'user.user_id = foto.id_user')
                ->like('judul_foto', $keyword)
                ->get()
                ->getResult();
}

public function getPhotoData($foto_id)
{
    return $this->find($foto_id);
}
}
