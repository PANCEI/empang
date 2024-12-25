<?php

namespace App\Models;

use CodeIgniter\Model;

class TambahAssetModel extends Model
{
    protected $table            = 'tambah_asset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kodeaset', 'jumlah', 'created_date'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_date';
    protected $updatedField  = null;
    protected $deletedField  = null;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['updateAssetJumlah'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Callback untuk menambahkan jumlah di tabel asset setelah insert
     */
    protected function updateAssetJumlah(array $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('assets');

        // Ambil kodeaset dan jumlah dari data yang di-insert
        $kodeaset = $data['data']['kodeaset'];
        $jumlah = $data['data']['jumlah'];

        // Update jumlah di tabel asset
        $builder->set('jumlah', "jumlah + $jumlah", false)
                ->where('kodeasset', $kodeaset)
                ->update();

        return $data;
    }

    
    public function reduceAssetJumlah($jumlah, $kodeaset)
    {
        $kodeaset = $kodeaset;
        $jumlah = $jumlah;
    
        // Kurangi jumlah di tabel asset
        $db = \Config\Database::connect();
        $builder = $db->table('assets');
        
        // Eksekusi update
        $builder->set('jumlah', "jumlah - $jumlah", false)
                ->where('kodeasset', $kodeaset);
        
        if ($builder->update()) {
            // Jika update berhasil
            return true;
        } else {
            // Jika update gagal
            return false;
        }
    }
    
    
    
    
    /**
     * Melakukan query left join dengan tabel assets berdasarkan kodeasset
     * 
     * @return array
     */
    public function getallassetmasuk()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tambah_asset');
        $builder->select('tambah_asset.*, assets.nama AS nama_asset');
        $builder->join('assets', 'assets.kodeasset = tambah_asset.kodeaset', 'left');
        $builder->orderBy('tambah_asset.id', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
