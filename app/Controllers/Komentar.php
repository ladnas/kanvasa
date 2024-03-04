<?php

namespace App\Controllers;
use App\Models\KomenModel;


class Komentar extends BaseController
{
    protected $session;
    protected $KomenModel;
    public function __construct()
    {
        $this->KomenModel = new KomenModel();
        $this->session = session();
    }

    
    public function tambahKomentar()
    {
        // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}
        // Ambil data dari formulir komentar
        $foto_id = $this->request->getPost('foto_id');
        $user_id = $this->session->get('user_id'); // Anda perlu sesuaikan ini sesuai dengan autentikasi pengguna Anda

        // Validasi data jika diperlukan

        // Simpan komentar ke database
       
        $data = [
            'foto_id' => $foto_id,
            'user_id' => $user_id,
            'isi_komentar' => $this->request->getPost('isi_komentar'),
            'tgl_komentar' => date('Y-m-d H:i:s')
        ];

        $this->KomenModel->insert($data);

    
        return redirect()->to("/detail/$foto_id");
    }

}
