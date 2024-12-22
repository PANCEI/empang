<?php

namespace App\Models;

use CodeIgniter\Model;

class AssetModel extends Model
{
    protected $table            = 'assets';
    protected $primaryKey       = 'kodeasset';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kodeasset', 'nama', 'jumlah', 'delete_mark', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'kodeasset'  => 'string',
        'nama'       => 'string',
        'jumlah'     => 'integer',
        'delete_mark'=> 'boolean',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'kodeasset' => 'required|alpha_numeric|max_length[255]',
        'nama'      => 'required|string|max_length[255]',
        'jumlah'    => 'required|integer',
        'delete_mark' => 'boolean',
    ];
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
    public function generateKodeAsset(): string
    {
        $lastAsset = $this->select('kodeasset')
                          ->orderBy('kodeasset', 'DESC')
                          ->limit(1)
                          ->get()
                          ->getRowArray();

        if ($lastAsset && preg_match('/EMP(\d+)/', $lastAsset['kodeasset'], $matches)) {
            $nextNumber = (int)$matches[1] + 1;
        } else {
            $nextNumber = 1;
        }
        return 'EMP' . $nextNumber;
    }
    //tulis 
}
