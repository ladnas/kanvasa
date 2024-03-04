<?php

namespace App\Controllers;
use App\Models\PostinganModel;
use App\Models\UserModel;
use App\Models\KomenModel;
use App\Models\LikeModel;
use App\Models\AlbumModel;
use App\Models\AlbumitemModel;

class Home extends BaseController
{
    protected $postinganModel;
    protected $userModel;
    protected $KomenModel;
    protected $LikeModel;
    protected $AlbumModel;
    protected $AlbumitemModel;
    protected $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->postinganModel = new PostinganModel();
        $this->KomenModel = new KomenModel();
        $this->LikeModel = new LikeModel();
        $this->AlbumModel = new AlbumModel();
        $this->AlbumitemModel = new AlbumitemModel();
        $this->session = session();
    }

    public function index()
    {
        $data['activepage'] = 'beranda';
        $data['foto'] = $this->postinganModel->orderBy('tgl_unggah', 'DESC')->limit(12)->getFotoWithUsername();
        $data['user_img'] = $this->userModel->where('user_id',$this->session->get('user_id'))->first();
        // var_dump($data['foto']);
        // die ;
        return view('beranda',$data);
    }

    public function login()
    {
        
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function jelajah()
    {
        $data['activepage'] = 'jelajah';
        $data['user_img'] = $this->userModel->where('user_id',$this->session->get('user_id'))->first();
        $data['foto'] = $this->postinganModel->getFotoWithUsername();
        shuffle($data['foto']);
        return view('jelajah', $data);
    }

    

    public function detail($foto_id)
    {
        
        $data['activepage'] = '';
        //data user
        $data['users'] = [
            'user_id' => $this->session->get('user_id'),
            'username' => $this->session->get('username'),
        ];
        // komen + like
        $data['komentar'] = $this->KomenModel->getKomentarWithUsername($foto_id);
        $data['total_komentar'] = $this->KomenModel->getTotalKomentar($foto_id);
        $data['total_like'] = $this->LikeModel->getTotalLike($foto_id);
        $isLiked = $this->LikeModel->isLiked($foto_id, $this->session->get('user_id')); 
        $data['isLiked'] = $isLiked;
        
        // foto dan nama user
        $data['poto'] = $this->postinganModel->getFotoById($foto_id);
        $data['user'] = $this->postinganModel->user($foto_id);

        // album
        $user = $this->session->get('user_id');  
        $data['albums'] = $this->AlbumModel->getAlbumsByuser($user);
        
        // Menambahkan informasi apakah foto berada dalam setiap album atau tidak
    foreach ($data['albums'] as &$album) {
        $album['included_in_album'] = ($this->AlbumitemModel->isPhotoInAlbum($foto_id, $album['album_id'])) ? true : false;
    }
        
        // persyaratan user
        $data['user_img'] = $this->userModel->where('user_id',$this->session->get('user_id'))->first();
        $data['isOwner'] = ($data['users']['user_id'] == $data['poto']['id_user']);
        return view('detail', $data);
    }

    public function profil()
    {
        $user_id = $this->session->get('user_id');
        $data['activepage'] = '';
        $data['user_img'] = $this->userModel->where('user_id',$this->session->get('user_id'))->first();
        $data['user'] = $this->userModel->where('user_id', $user_id)->first();
        $data['user_posts'] = $this->postinganModel->getPostByUserId($user_id);
        $user = $this->session->get('user_id'); 
        $data['albume'] = $this->AlbumModel->getAlbumsWithPhotos($user);
        return view('profil', $data);
    }
}
