<?php

namespace App\Controllers;

use App\Models\AlbumitemModel;
use App\Models\UserModel;
use App\Models\AlbumModel;

class Albumitem extends BaseController
{
    protected $AlbumModel;
    protected $AlbumitemModel;
    protected $userModel;
    protected $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->AlbumitemModel = new AlbumitemModel();
        $this->AlbumModel = new AlbumModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
    }

    public function viewPhoto($albumitem_id)
    {
        $data['activepage'] = '';
        $user_id = $this->session->get('user_id');
        // Kirim data foto ke view
        $data['NamaAlbum'] =  $this->AlbumModel->getAlbumByAlbumItemId($albumitem_id);
        $data['photo'] = $this->AlbumitemModel->getFoto($albumitem_id, $user_id);
        $data['user_img'] = $this->userModel->where('user_id', $this->session->get('user_id'))->first();
        //    var_dump($data);
        //    die;
        return view('albumdetail', $data);
    }

    public function addToAlbum($foto_id, $album_id)
    {
        // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}

        // Validate IDs
        if (!is_numeric($foto_id) || !is_numeric($album_id) || $foto_id <= 0 || $album_id <= 0) {
            return redirect()->back()->with('error', 'Invalid photo ID or album ID.');
        }

        $user_id = $this->session->get('user_id');

        // Cek apakah kombinasi foto_id dan album_id sudah ada di tabel forpost
        $existingForpost = $this->AlbumitemModel->where(['foto_id' => $foto_id, 'album_id' => $album_id, 'user_id' => $user_id])->first();

        if (!$existingForpost) {
            // Jika belum ada, tambahkan ke tabel forpost
            $this->AlbumitemModel->save([
                'foto_id' => $foto_id,
                'album_id' => $album_id,
                'user_id' => $user_id,
            ]);

            return redirect()->back()->with('success', 'Foto berhasil ditambahkan ke album.');
        } else {
            // Jika sudah ada, beri pesan atau tindakan sesuai kebutuhan
            return redirect()->back()->with('error', 'Foto sudah ada di album.');
        }
    }

    public function removeFromAlbum($foto_id, $album_id)
{
    // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}
    // Dapatkan user_id dari session
    $user_id = $this->session->get('user_id');

    // Validate IDs
    if (!is_numeric($foto_id) || !is_numeric($album_id) || $foto_id <= 0 || $album_id <= 0) {
        return redirect()->back()->with('error', 'Invalid photo ID or album ID.');
    }                           

    // Cek apakah albumitem_id yang dimaksud milik user yang sedang login
    $albumItem = $this->AlbumitemModel->where('foto_id', $foto_id)
        ->where('album_id', $album_id)
        ->first();

    if (!$albumItem || $albumItem['user_id'] != $user_id) {
        return redirect()->back()->with('error', 'Album item not found or you do not have permission to delete it.');
    }

    // Hapus albumitem
    $this->AlbumitemModel->delete($albumItem['albumitem_id']);

    return redirect()->back()->with('success', 'Album item has been removed successfully.');
}

}
