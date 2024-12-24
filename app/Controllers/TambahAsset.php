<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TambahAssetModel;
use App\Models\AssetModel;
class TambahAsset extends BaseController
{
    private $tambah;
    private $asset;
    public function __construct()
    {
        $this->tambah = new TambahAssetModel();
        $this->asset = new AssetModel();
        
    }
    public function index()
    {
        return view('assets/tambah');
    }
    public function getAllAssets()
    {
        $data = $this->asset->getDataKodeAssetDanNama();
        return $this->response->setJSON($data);
    }
}
