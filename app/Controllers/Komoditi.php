<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KomoditiModel;
class Komoditi extends BaseController
{
    private $komoditi;
    public function __construct()
    {
        $this->komoditi= new KomoditiModel();
    }
    public function index()
    {
        $data=[
            'komoditi'=>$this->komoditi->findAll()
        ];
    return view('komoditi/index', $data);
    }
    public function tambah(){
    if(!$this->validate([
        'komoditi'=>'required'
    ])){
        session()->setFlashdata('error','Masukan Inputan Dengan Benar');
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error')
        ]);
    }
    $data=[
        'jenis_komoditi'=>$this->request->getVar('komoditi'),
        'created_at'=>date('Y-m-d H:i:s')
    ];
    $cek=$this->komoditi->insert($data);
    if($cek){
        session()->setFlashdata('success','Data Berhasil Di masukan');
    }else{
        session()->setFlashdata('error','Komoditi Gagal Di Tambahkan');
    }
    return $this->response->setJSON([
        'success'=>session()->getFlashdata('success'),
        'error'=>session()->getFlashdata('error')
    ]);
    
    }
}
