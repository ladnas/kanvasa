<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'username', 'password', 'email', 'nama_lengkap', 'alamat', 'foto_profil', 'bio', 'verified'];  
    

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



    public function postingan()
    {
        return $this->hasOne(PostinganModel::class, 'id_user', 'user_id');
    }

    public function editProfil($user_id, $data)
    {
        // Lakukan update berdasarkan ID user
        $this->update($user_id, $data);

        return $this->find($user_id); // Mengembalikan data user setelah diupdate
    }

}
