<?php

namespace App\Controllers;

use App\Models\LikeModel;
use CodeIgniter\Controller;

class Likes extends Controller
{
    protected $session;
    protected $LikeModel;
    public function __construct()
    {
        $this->LikeModel = new LikeModel();
        $this->session = session();
    }

    public function likeDislike($foto_id)
{
    // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}

    // Dapatkan user_id dari sesi atau autentikasi pengguna
    $user_id = $this->session->get('user_id');

    // Periksa apakah user sudah melike postingan ini
    $isLiked = $this->LikeModel->isLiked($foto_id, $user_id);

    if ($isLiked) {
        // Jika sudah melike, hapus like dari database
        $this->LikeModel->deleteLike($foto_id, $user_id);
    } else {
        // Jika belum melike, tambahkan like ke database
        $data = [
            'foto_id' => $foto_id,
            'user_id' => $user_id,
            'tgl_like' => date('Y-m-d H:i:s'),
        ];
        $this->LikeModel->insert($data);
    }

    // Redirect atau lakukan sesuatu setelah like/dislike
    return redirect()->to("/detail/$foto_id");
}
}