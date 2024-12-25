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

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
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
    protected $beforeDelete   = ['deleteRelatedData']; // Tambahkan callback di sini
    protected $afterDelete    = [];

    public function generateKodeAsset(): string
    {
        do {
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
    
            $newKodeAsset = 'EMP' . $nextNumber;
    
            // Cek apakah kode sudah ada di database
            $exists = $this->where('kodeasset', $newKodeAsset)->countAllResults() > 0;
    
        } while ($exists); // Ulangi jika kode sudah ada
    
        return $newKodeAsset;
    }

    /**
     * Callback untuk menghapus data terkait di tabel tambah_asset
     *
     * @param array $data
     * @return array
     */
    protected function deleteRelatedData(array $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tambah_asset');

        if (isset($data['kodeasset'])) {
            foreach ($data['kodeasset'] as $kodeasset) {
                // Hapus data di tabel tambah_asset berdasarkan kodeasset
                $builder->where('kodeasset', $kodeasset)->delete();
            }
        }

        return $data;
    }
    /**
     * Mendapatkan data kodeasset dan nama secara manual
     *
     * @return array
     */
    public function getDataKodeAssetDanNama()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT kodeasset, nama FROM assets WHERE delete_mark = 0");
        return $query->getResultArray();
    }
}
