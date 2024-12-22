<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AssetModel;
class Asset extends BaseController
{
    private $asset;
    public function __construct(){
        $this->asset= new AssetModel();
    }
    public function index()
    {
        $data= $this->asset->orderBy('kodeasset', 'DESC')->findAll();
    return view('assets/index', $data);
    }
    public function generateKode(){
        $kodeAsset = $this->asset->generateKodeAsset();
        return $this->response->setJSON(['kode' => $kodeAsset]); // Kembalikan JSON
    }
    
}

