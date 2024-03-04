<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumModel extends Model
{
    protected $table = 'album';
    protected $primaryKey = 'album_id';
    protected $allowedFields = ['nama_album', 'deskripsi', 'tgl_dibuat', 'user_id'];

    public function getAlbumsByUser($user_id)
    {
        // Ambil daftar album berdasarkan user_id
        return $this->where('user_id', $user_id)->findAll();
    }

    public function getAlbumsWithPhotos($user_id)
    {
        return $this->select('album.album_id, album.nama_album, album.deskripsi, album.tgl_dibuat, album.user_id, MIN(foto.lokasi_file) as lokasi_file')
            ->join('albumitem', 'albumitem.album_id = album.album_id')
            ->join('foto', 'foto.foto_id = albumitem.foto_id')
            ->where('album.user_id', $user_id)
            ->groupBy('album.album_id') // Group by album_id to get only one photo per album
            ->findAll();
    }

    public function editAlbumName($album_id, $new_album_name)
    {
        // Cek apakah album dengan $album_id ada dalam database
        $album = $this->find($album_id);

        if (!$album) {
            return false; // Album tidak ditemukan
        }

        // Update nama album
        $this->update($album_id, ['nama_album' => $new_album_name]);

        return true; // Nama album berhasil diupdate
    }

    public function getAlbumByAlbumItemId($album_id)
    {
        return $this->db->table('album')
            ->join('albumitem', 'albumitem.album_id = album.album_id')
            ->join('user', 'user.user_id = albumitem.user_id')
            ->where('albumitem.album_id', $album_id)
            ->select('album.album_id, album.nama_album, album.deskripsi')
            ->get()
            ->getRowArray();
    }
}
