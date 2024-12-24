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
    protected $afterDelete    = ['reduceAssetJumlah'];

    /**
     * Callback untuk menambahkan jumlah di tabel asset setelah insert
     */
    protected function updateAssetJumlah(array $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('asset');

        // Ambil kodeaset dan jumlah dari data yang di-insert
        $kodeaset = $data['data']['kodeaset'];
        $jumlah = $data['data']['jumlah'];

        // Update jumlah di tabel asset
        $builder->set('jumlah', "jumlah + $jumlah", false)
                ->where('kodeaset', $kodeaset)
                ->update();

        return $data;
    }

    /**
     * Callback untuk mengurangi jumlah di tabel asset setelah delete
     */
    protected function reduceAssetJumlah(array $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('asset');

        // Ambil id dari data yang dihapus
        $id = $data['id'];

        // Ambil data terkait dari tabel tambah_asset sebelum dihapus
        $deletedData = $this->find($id);

        if ($deletedData) {
            $kodeaset = $deletedData['kodeaset'];
            $jumlah = $deletedData['jumlah'];

            // Kurangi jumlah di tabel asset
            $builder->set('jumlah', "jumlah - $jumlah", false)
                    ->where('kodeaset', $kodeaset)
                    ->update();
        }

        return $data;
    }
}
