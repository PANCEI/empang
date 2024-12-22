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
    return view('assets/index');
    }
}
