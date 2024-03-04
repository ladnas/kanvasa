<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PostinganModel;

class Post extends BaseController
{
    protected $session;
    protected $PostinganModel;
    protected $UserModel;
    public function __construct()
    {
        $this->PostinganModel = new PostinganModel();
        $this->UserModel = new UserModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
    }

    
    public function buat()
    {
        // Periksa apakah sesi 'userisLogin' sudah ada
    if (!session()->has('userisLogin')) {
    // Jika tidak, set pesan flash untuk memberitahu pengguna untuk login terlebih dahulu
    session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
    // Redirect kembali ke halaman sebelumnya atau halaman login, sesuai kebutuhan
    return redirect()->to('/login');
}
        $data['user_img'] = $this->UserModel->where('user_id',$this->session->get('user_id'))->first();
        $data['activepage'] = 'buat';
        $userId = session()->get('user_id');
        $data['userId'] = $userId;
        return view('buat',$data);
    }

    public function posting()
    {
        $userId = session()->get('user_id');
        $date = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $formattedDate = $date->format('Y-m-d');
        
        // Set aturan validasi
        $this->validation->setRule('lokasi_file', 'Gambar', 'uploaded[lokasi_file]|max_size[lokasi_file,1024]|mime_in[lokasi_file,image/jpg,image/jpeg,image/png]');
        $this->validation->setRule('judul_foto', 'Judul Foto', 'required|max_length[255]');
        $this->validation->setRule('desk_foto', 'Deskripsi Foto', 'required');
        // Jalankan validasi
        if (!$this->validation->withRequest($this->request)->run()) {
            // Validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $data = [
            'judul_foto' => $this->request->getPost('judul_foto'),
            'tgl_unggah' => $formattedDate,
            'id_user' => $userId,
            'desk_foto' => $this->request->getPost('desk_foto'),
        ];

        // Upload image
        $file = $this->request->getFile('lokasi_file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('./uploads', $newName);
            $data['lokasi_file'] = $newName;
        }

        // Save to database
        $this->PostinganModel->insert($data);

        // Redirect to the index or show success message
        return redirect()->to('/');
    }

    public function editDetail($foto_id)
    {
        $data['activepage'] = '';
        
        $data['poto'] = $this->PostinganModel->getFotoById($foto_id);
        $data['user'] = $this->PostinganModel->user($foto_id);
        $data['user_img'] = $this->UserModel->where('user_id',$this->session->get('user_id'))->first();
        return view('Edit', $data);
    }

    public function update($foto_id)
{
    // Validate Photo ID
    if (!is_numeric($foto_id) || $foto_id <= 0) {
        return redirect()->back()->withInput()->with('errors', ['Invalid photo ID.']);
    }

    // Set rules for validation
    $this->validation->setRule('judul_foto', 'Judul Foto', 'required|max_length[255]');
    $this->validation->setRule('desk_foto', 'Deskripsi Foto', 'required');
    $this->validation->setRule('lokasi_file', 'Gambar', 'uploaded[lokasi_file]|mime_in[lokasi_file,image/jpg,image/jpeg,image/png]|max_size[lokasi_file,2048]');

    // Run validation
    if (!$this->validation->withRequest($this->request)->run()) {
        // If validation fails, redirect back with errors
        return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
    }

    // Get existing photo data
    $photoData = $this->PostinganModel->getPhotoData($foto_id);

    // Handle form submission and update the photo in the database
    $data = [
        'judul_foto' => $this->request->getPost('judul_foto'),
        'desk_foto' => $this->request->getPost('desk_foto'),
    ];

    // Check if a new image is uploaded
    $file = $this->request->getFile('lokasi_file');
    if ($file->isValid() && !$file->hasMoved()) {
        // If a new image is uploaded, move it to the uploads directory
        $newName = $file->getRandomName();
        $file->move('./uploads', $newName);
        $data['lokasi_file'] = $newName;

        // Delete the old image if it exists
        if ($photoData['lokasi_file'] && file_exists('./uploads/' . $photoData['lokasi_file'])) {
            unlink(realpath('./uploads/' . $photoData['lokasi_file']));
        }
    } else {
        // If no new image is uploaded, retain the existing image
        $data['lokasi_file'] = $photoData['lokasi_file'];
    }

    // Update the photo record in the database
    $this->PostinganModel->updatePost($foto_id, $data);

    // Redirect to the photo detail page
    return redirect()->to(base_url("/detail/{$foto_id}"));
}

    public function delete($foto_id)
    {
        // Delete the report from the database

        $report = $this->PostinganModel->find($foto_id);

        // Delete the image file
        if ($report['lokasi_file'] != null) {
            unlink('./uploads/' . $report['lokasi_file']);
        }

        // Delete the record from the database
       
        $this->PostinganModel->delete($foto_id);

        // Redirect to the index or show success message
        return redirect()->to('/');
    }

    public function search()
{
    $keyword = $this->request->getGet('keyword'); // Menggunakan getGet() untuk mendapatkan nilai dari query string

    // Simpan nilai input dalam session
    session()->setFlashdata('search_keyword', $keyword);

    $data['activepage'] = 'jelajah';
    $data['user_img'] = $this->UserModel->where('user_id', $this->session->get('user_id'))->first();
    $data['foto'] = $this->PostinganModel->searchPosts($keyword);

    return view('jelajah', $data);
}


}
