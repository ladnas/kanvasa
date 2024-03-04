<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $validation;
    protected $session;
    public function __construct()
    {
        //membuat user model untuk konek ke database 
        $this->userModel = new UserModel();

        //meload validation
        $this->validation = \Config\Services::validation();

        //meload session
        $this->session = \Config\Services::session();
        
    }

    public function login()
    {
        //menampilkan halaman login
        
        return view('Login');
    }

    public function register()
    {
        //menampilkan halaman register
        return view('register');
    }

    public function verify()
    {
        //menampilkan halaman register
        return view('verifikasi');
    }
    public function valid_register()
    {
        // Tangkap data dari form 
        $data = $this->request->getPost();
    
        // Jalankan validasi
        $this->validation->run($data, 'register');
    
        // Cek errornya
        $errors = $this->validation->getErrors();
    
        // Jika ada error kembalikan ke halaman register
        if ($errors) {
            session()->setFlashdata('error', $errors);
            return redirect()->to('register');
        }
    
        // Hash password digabung dengan salt
        $password = md5($data['password']);
        $profil = '/default/pfp.png';
    
        // Masukan data ke database
        $this->userModel->save([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $password,
            'foto_profil' => $profil,
            'verified' => false, // Tambahkan status verifikasi
        ]);
    
        // Kirim email verifikasi
        $email = \Config\Services::email();
    
        $email->setTo($data['email']);
        $email->setFrom('kanvasa249@gmail.com', 'Kanvasa');
        $email->setSubject('Account Verification');
        $email->setMessage('Hello, please click on the link below to verify your account: ' . base_url('verifyaccount/' . $data['email'])); // Ganti dengan URL verifikasi yang sesuai
    
        if ($email->send()) {
            session()->setFlashdata('verification_email', 'Cek akun email anda untuk verifikasi email anda.');
        } else {
            session()->setFlashdata('error', 'Failed to send verification email.');
        }
    
        // Arahkan ke halaman login
        return redirect()->to('login');
    }

    public function valid_login()
    {
        // Get data from the form
        $data = $this->request->getPost();
        
        $this->validation->run($data, 'login');

    // Cek errornya
    $errors = $this->validation->getErrors();
        // Check if a user with the given 'username'
        $user = $this->userModel->where('username', $data['username'])->first();
    
        // Check if a user is found in the 'user' table
        if ($user) {
            // Check if the password matches
            if ($user['password'] != md5($data['password'])) {
                session()->setFlashdata('password', 'Wrong Password');
                return redirect()->to('login');
            } else {
                // Check if the account is verified
                if ($user['verified'] == true) {
                    // Set session and redirect user to homepage
                    $session = session();
                    $session->set('user_id', $user['user_id']);
                    $session->set('email', $user['email']);
                    $sessLogin = [
                        'userisLogin' => true,
                        'username' => $user['username'],
                    ];
                    $this->session->set($sessLogin);
                    return redirect()->to('/');
                } else {
                    // If the account is not verified, show flash message and redirect to login page
                    session()->setFlashdata('not_verified', 'Your account has not been verified yet.');
                    return redirect()->to('login');
                }
            }
        } else {
            // If user not found, show flash message and redirect to login page
            session()->setFlashdata('username', 'Username not found');
            return redirect()->to('login');
        }
    }
  
    public function logout()
    {
        //hancurkan session 
        //balikan ke halaman login
        $this->session->destroy();
        return redirect()->to('/');
    }

    public function verifyAccount($email)
{
    // Cari pengguna berdasarkan alamat email
    $user = $this->userModel->where('email', $email)->first();

    // Jika pengguna tidak ditemukan
    if (!$user) {
        // Tampilkan pesan kesalahan atau redirect ke halaman lain
        return redirect()->to('/login')->with('error', 'User not found.');
    }

    // Jika pengguna sudah terverifikasi
    if ($user['verified']) {
        // Redirect ke halaman login dengan pesan sukses
        return redirect()->to('/login')->with('info', 'Your account is already verified. You can now log in.');
    }

    // Tandai akun sebagai terverifikasi
    $this->userModel->update($user['user_id'], ['verified' => true]);

    // Redirect ke halaman login dengan pesan sukses
    return redirect()->to('/login')->with('success', 'Your account has been verified successfully. You can now log in.');
}

}