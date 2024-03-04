<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumitemModel extends Model
{
    protected $table = 'albumitem';
    protected $primaryKey = 'albumitem_id';
    protected $allowedFields = ['album_id', 'foto_id', 'user_id'];

    // Fungsi untuk mendapatkan postingan berdasarkan album_id
    public function getPostsByAlbum($album_id)
    {
        return $this->where('album_id', $album_id)->findAll();
    }

    // Fungsi untuk menyimpan postingan ke dalam album
    public function savePost($foto_id, $album_id, $user_id)
    {
        $data = [
            'foto_id' => $foto_id,
            'album_id' => $album_id,
            'user_id' => $user_id,
        ];

        return $this->save($data);
    }

    // Fungsi untuk menghapus postingan dari album

    public function getFoto($album_id, $user_id)
    {
        return $this->select('foto.foto_id, foto.judul_foto, foto.lokasi_file, user.foto_profil, user.username')
            ->join('foto', 'foto.foto_id = albumitem.foto_id')
            ->join('user', 'user.user_id = foto.id_user')
            ->where('albumitem.album_id', $album_id)
            ->where('albumitem.user_id', $user_id)
            ->findAll();
    }

    public function getAlbumByAlbumItemId($albumitem_id)
{
    return $this->db->table('album')
        ->join('albumitem', 'albumitem.album_id = album.album_id')
        ->where('albumitem.albumitem_id', $albumitem_id)
        ->select('album.nama_album, album.deskripsi')
        ->get()
        ->getRowArray();
}

   
    public function isPhotoInAlbum($foto_id, $album_id)
    {
        $result = $this->where('foto_id', $foto_id)
            ->where('album_id', $album_id)
            ->countAllResults();
        return $result > 0 ? true : false;
    }
}
