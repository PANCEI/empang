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
        $data = [
            'asset'=>$this->asset->where('delete_mark', 0)->orderBy('kodeasset', 'DESC')->findAll()
        ];
    return view('assets/index', $data);
    }
    public function generateKode(){
        $kodeAsset = $this->asset->generateKodeAsset();
        return $this->response->setJSON(['kode' => $kodeAsset]); // Kembalikan JSON
    }
    public function tambah(){
     // var_dump($_POST);
        if(!$this->validate([
            'kodeasset'=>'required',
            'Asset'=>'required'
        ])){
            session()->setFlashdata('error','Inputan Yang Di Masukan Harus Lengkap');
            return $this->response->setJSON([
                'error'=>session()->getFlashdata('error')
            ]);
        }
        $data=[
            'kodeasset'=>$this->request->getVar('kodeasset'),
            'nama'=>$this->request->getVar('Asset'),
            'created_at'=>date('Y-m-d H:i:s'),
            'jumlah'=>0
        ];
        $cek= $this->asset->save($data);
        if($cek){
            session()->setFlashdata('success','Asset Baru Berhasil Di Tambahkan');
        }else{
            session()->setFlashdata('error','Asset Gagal Di Masukan');
        }
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error'),
            'success'=>session()->getFlashdata('success')
        ]);

    }
    public function getall(){
        $data=$this->asset->where('delete_mark', 0)->orderBy('kodeasset', 'DESC')->findAll();
        return $this->response->setJSON($data);
    }
    public function edit(){
       // var_dump($_POST);
        if(!$this->validate([
            'editkodeasset'=>'required',
            'editnama'=>'required'
        ])){
            session()->setFlashdata('error','Harap Inputkan Semua Field');
            return $this->response->setJSON([
                'error'=>session()->getFlashdata('error')
            ]);
        }
        $id=$this->request->getVar('editkodeasset');
        $data=[
            'nama'=>$this->request->getVar('editnama')
        ];
       
        $cek=$this->asset->update($id,$data);
        if($cek){
            session()->setFlashdata('success','Berhasil Melakukan Edit');

        }else{
            session()->setFlashdata('error','Gagal Melakukan Edit Data');
        }
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error'),
            'success'=>session()->getFlashdata('success')
        ]);
    }
    public function delete(){
        $id=$this->request->getVar('kodeasset');
        $data=[
            'delete_mark'=>1,
            'deleted_at'=>date('Y-m-d H:i:s')
        ];
        $cek=$this->asset->update($id,$data);
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

