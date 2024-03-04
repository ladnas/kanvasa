<?php

namespace App\Controllers;

use App\Models\AlbumModel;
use CodeIgniter\Controller;
use App\Models\AlbumitemModel;
class Albums extends Controller
{
    protected $AlbumModel;
    protected $AlbumitemModel;
    protected $session;
    public function __construct()
    {
        
        $this->AlbumModel = new AlbumModel();
        $this->AlbumitemModel = new AlbumitemModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
        
    }
    public function index()
    {
        // Tampilkan daftar album per Album
        

        return view('album/index', $data);
    }

    public function create()
    {
        // Tampilkan halaman form untuk membuat album
        return view('album/create');
    }

    public function createAlbum($foto_id)
{
    // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}

    // Validasi input nama_album dan deskripsi
    $this->validation->setRule('nama_album', 'Nama Album', 'required|max_length[255]');
    $this->validation->setRule('deskripsi', 'Deskripsi', 'max_length[255]');

    // Jalankan validasi
    if (!$this->validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
    }

    // Simpan album baru ke database
    $user_id = $this->session->get('user_id');

    $data = [
        'nama_album' => $this->request->getPost('nama_album'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'user_id' => $user_id,
        'tgl_dibuat' => date('Y-m-d')
    ];

    $this->AlbumModel->save($data);
    
    return redirect()->to("/detail/$foto_id");
}

    

public function edit($album_id)
{
    // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}

    // Validasi ID album
    if (!is_numeric($album_id) || $album_id <= 0) {
        return redirect()->back()->with('error', 'Invalid album ID.');
    }

    // Dapatkan data album berdasarkan album_id
    $album = $this->AlbumModel->find($album_id);

    // Pastikan album ditemukan
    if (!$album) {
        return redirect()->back()->with('error', 'Album not found.');
    }

    // Cek apakah album milik user yang sedang login
    $user_id = $this->session->get('user_id');
    if ($album['user_id'] != $user_id) {
        return redirect()->back()->with('error', 'You do not have permission to edit this album.');
    }

    // Validasi input nama_album dan deskripsi
    $this->validation->setRule('nama_album', 'Nama Album', 'required|max_length[255]');
    $this->validation->setRule('deskripsi', 'Deskripsi', 'max_length[255]');

    // Jalankan validasi
    if (!$this->validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
    }

    // Update nama album dan deskripsi
    $data = [
        'nama_album' => $this->request->getPost('nama_album'),
        'deskripsi' => $this->request->getPost('deskripsi')
    ];
    $this->AlbumModel->update($album_id, $data);
    
    return redirect()->back()->with('success', 'Album has been updated successfully.');
}


public function delete($album_id)
{
    // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}
    // Dapatkan data album berdasarkan album_id
    $album = $this->AlbumModel->find($album_id);

    // Pastikan album ditemukan
    if (!$album) {
        return redirect()->to('/profil')->with('error', 'Album not found.');
    }

    // Tampilkan konfirmasi penghapusan menggunakan modal Bootstrap
    echo view('confirmation_modal', ['album_id' => $album_id]);

    // Setelah pengguna mengkonfirmasi penghapusan, hapus album dan postingan terkait
}

public function confirmDelete()
{
    // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}
    // Ambil album_id dari form
    $album_id = $this->request->getPost('album_id');

    // Hapus album dan postingan terkait
    $AlbumitemModel = new \App\Models\AlbumitemModel();

    // Hapus postingan terkait
    $AlbumitemModel->where('album_id', $album_id)->delete();

    // Hapus album
    $this->AlbumModel->delete($album_id); ;

    return redirect()->to('/profil')->with('success', 'Album and its contents have been deleted successfully.');
}
}
