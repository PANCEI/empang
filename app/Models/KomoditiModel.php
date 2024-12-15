<?php

namespace App\Models;

use CodeIgniter\Model;

class KomoditiModel extends Model
{
    protected $table            = 'komoditi';
    protected $primaryKey       = 'id_komoditi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jenis_komoditi','created_at','updated_at'];

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;



    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
