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
        // echo "masuk ini";
        $data = [
            'masuk'=>$this->tambah->getallassetmasuk()
        
        ];
        return view('assets/tambaha', $data);
    }
    public function getAllAssets()
    {
        $data = $this->asset->getDataKodeAssetDanNama();
        return $this->response->setJSON($data);
    }
    public function getdataall(){
        $data = $this->tambah->getallassetmasuk();
        return $this->response->setJSON($data);
    }
    public function tambah(){
       // var_dump($_POST);
        if(!$this->validate([
            'kodeasset'=>'required',
            'jumlah'=>'required'
        ])){
            session()->setFlashdata('error','Harap Lengkapi Inputan');
            return $this->response->setJSON([
                'error'=>session()->getFlashdata('error')
            ]);
        }
        $data=[
            'kodeaset'=>$this->request->getVar('kodeasset'),
            'jumlah'=>$this->request->getVar('jumlah'),
            'created_date'=>date('Y-m-d H:i:s')
        ];
        $cek= $this->tambah->save($data);
        if($cek){
            session()->setFlashdata('success','Berhasil Memasukan data baru');
        }else{
            session()->setFlashdata('error','Gagal Memasukan Data');
        }
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error'),
            'success'=>session()->getFlashdata('success')
        ]);
    }
    public function delete(){
        $id=$this->request->getVar('id');
        $temu=$this->tambah->find($id);
     // var_dump($temu['kodeaset'],$temu['jumlah']);
      $kurang= $this->tambah->reduceAssetJumlah($temu['jumlah'],$temu['kodeaset']);
      if($kurang){
        $cek = $this->tambah->delete($id);
        if($cek){
            session()->setFlashdata('success','Berhasil Menghapus Data');
        }else{
            session()->setFlashdata('error','Gagal Menghapus Data');
        }
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error'),
            'success'=>session()->getFlashdata('success')
            ]); 
    }
      }
        
}
