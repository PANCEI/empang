<?php

namespace App\Models;

use CodeIgniter\Model;

class AssetKeluarModel extends Model
{
    protected $table            = 'asset_keluar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kodeaset', 'jumlah', 'keterangan', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

  

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
    protected $deletedField  = null;
    public function getallassetkeluar()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('asset_keluar');
        $builder->select('asset_keluar.*, assets.nama AS nama_asset');
        $builder->join('assets', 'assets.kodeasset = asset_keluar.kodeaset', 'left');
        $builder->orderBy('asset_keluar.id', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function tambahasset($jumlah, $kodeaset)
    {
        $kodeaset = $kodeaset;
        $jumlah = $jumlah;
    
        // Kurangi jumlah di tabel asset
        $db = \Config\Database::connect();
        $builder = $db->table('assets');
        
        // Eksekusi update
        $builder->set('jumlah', "jumlah + $jumlah", false)
                ->where('kodeasset', $kodeaset);
        
        if ($builder->update()) {
            // Jika update berhasil
            return true;
        } else {
            // Jika update gagal
            return false;
        }
    }
}
