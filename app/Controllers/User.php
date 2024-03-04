<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    protected $session;
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
    }
    
    public function index()
    {
        //cek apakah ada session bernama isLogin
        if(!$this->session->has('userisLogin')){
            return redirect()->to('/login');
        }

        return view('beranda');
    }

    public function edit_profil()
    {
        $user_id = session()->get('user_id');
        $data['user_img'] = $this->UserModel->where('user_id',$this->session->get('user_id'))->first();
        $data['user'] = $this->UserModel->find($user_id);
        $data['activepage'] = '';
        
        return view('edit_profil', $data);
    }
    
    public function editProfil()
{
    // Ambil user_id dari session
    $user_id = session()->get('user_id');

    // Tangkap data dari form
    $data = [
        'email' => $this->request->getPost('email'),
        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        'bio' => $this->request->getPost('bio'),
        'alamat' => $this->request->getPost('alamat'),
    ];

    // Pengecekan apakah ada perubahan pada username
    if ($this->request->getPost('username') !== null) {
        // Pengecekan ke database untuk username baru
        $username = $this->request->getPost('username');
        $existingUser = $this->UserModel->where('username', $username)
                                        ->where('user_id !=', $user_id)
                                        ->first();
        if ($existingUser) {
            return redirect()->back()->withInput()->with('error', 'Username sudah dipakai.');
        }
        // Set aturan validasi untuk username
        $data['username'] = $username;
    }

    // Validasi input
    $this->validation->setRule('email', 'Email', 'required|valid_email|max_length[225]');
    $this->validation->setRule('nama_lengkap', 'Nama Lengkap', 'permit_empty|string|max_length[225]');
    $this->validation->setRule('bio', 'Bio', 'permit_empty|string|max_length[225]');
    $this->validation->setRule('alamat', 'Alamat', 'permit_empty|string|max_length[225]');

    // Mengelola foto profil
    $fotoProfil = $this->request->getFile('foto_profil');

    if ($fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
        // Hapus foto profil yang lama jika tidak menggunakan yang baru
        $user = $this->UserModel->find($user_id);
        if ($user && $user['foto_profil'] && file_exists('./profile/' . $user['foto_profil'])) {
            unlink('./profile/' . $user['foto_profil']);
        }

        $newFotoProfilName = $fotoProfil->getRandomName();
        $fotoProfil->move('./profile/', $newFotoProfilName);

        // Tambahkan nama file foto profil baru ke data yang akan diupdate
        $data['foto_profil'] = "/profile/" . $newFotoProfilName;
    }

    // Jalankan validasi
    if (!$this->validation->withRequest($this->request)->run($data)) {
        return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
    }

    // Panggil fungsi editProfil pada model untuk melakukan update
    $this->UserModel->editProfil($user_id, $data);

    // Tampilkan pesan sukses jika berhasil
    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}
   
}