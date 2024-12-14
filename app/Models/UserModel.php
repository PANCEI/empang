<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email','username'.'password','telpon'.'aktif','user_created_at','user_updated_at'];

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

 

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    public function getEmail($email){
        return $this->where('email',$email)->first();
    }
}
