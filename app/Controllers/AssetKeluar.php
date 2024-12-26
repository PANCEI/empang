<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpParser\Node\Expr\FuncCall;
use App\Models\AssetModel;
use App\Models\AssetKeluarModel;
use App\Models\TambahAssetModel;
class AssetKeluar extends BaseController
{
    private $aset;
    private $keluar;
    private $tambah;
    public function __construct()
    {
        $this->aset = new AssetModel();
        $this->keluar = new AssetKeluarModel();
        $this->tambah = new TambahAssetModel();
    }
    public function index()
    {
        $data=[
            'keluar'=>$this->keluar->getallassetkeluar()
        ];
        return view('assets/keluar', $data);
    }
    public function getall(){
        $data=$this->keluar->getallassetkeluar();
        return $this->response->setJSON($data);
    }
    public function tambah(){
   
        if(!$this->validate([
            'kodeasset'=>'required',
            'jumlah'=>'required',
            'keterangan'=>'required'
        ])){
            session()->setFlashdata('error','Inputan Harap Di Lengkapi');
            return $this->response->setJSON([
                'error'=>session()->getFlashdata('error')
            ]);
        }
        $cekJumlah= $this->aset->find($this->request->getVar('kodeasset'));
       // var_dump($cekJumlah);
        if($this->request->getVar('jumlah') > $cekJumlah['jumlah']){
            session()->setFlashdata('error','Jumlah yang diinputkan melebihi jumlah yang Asset Yang ada');
        }else{
            $kurang= $this->tambah->reduceAssetJumlah($this->request->getVar('jumlah'),$this->request->getVar('kodeasset'));
            if($kurang){
                $data=[
                    'kodeaset'=>$this->request->getVar('kodeasset'),
                    'jumlah'=>$this->request->getVar('jumlah'),
                    'keterangan'=>$this->request->getVar('keterangan'),
                    'created_at'=>date('Y-m-d H:i:s')
                ];
                $cek= $this->keluar->save($data);
                if($cek){
                session()->setFlashdata('success','Asset Berhasil Di Keluarkan');
                }else{
                    session()->setFlashdata('error','Gagal Mengeluarkan Asset');
                }
            }
        }
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error'),
            'success'=>session()->getFlashdata('success')
        ]);

    }
    public function delete(){
     $id = $this->request->getVar('id');
     $temu= $this->keluar->find(2);
     $kembalikan_value= $this->keluar->tambahasset($temu['jumlah'],$temu['kodeaset']);
     if($kembalikan_value){
     $cek=$this->keluar->delete($id);
     if($cek){
        session()->setFlashdata('success','Asset  Keluar Berhasil Di Delete');
     }else{
        session()->setFlashdata('error','Gagal Menghapus Asset');
     }
    }else{
        session()->setFlashdata('error','Gagal Mengembalikan Asset');
    }

    return $this->response->setJSON([
        'error'=>session()->getFlashdata('error'),
        'success'=>session()->getFlashdata('success')
    ]);
    }
}
