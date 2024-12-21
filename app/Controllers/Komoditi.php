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
public function getKomoditi(){
    $data=$this->komoditi->findAll();
    return $this->response->setJSON($data);
}
public function editKomoditi(){
    if(!$this->validate([
        'id_komoditi'=>'required',
        'komoditi'=>'required',
    ])){
        session()->setFlashdata('error','Data Inputan Yang Di Masukan Tidak Lengkap');
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error')
        ]);
    }
    $id=$this->request->getVar('id_komoditi');
    $data=[
        'jenis_komoditi'=>$this->request->getVar('komoditi'),
        'updated_at'=>date('Y-m-d H:i:s')
    ];

    $cek= $this->komoditi->update($id, $data);
    if($cek){
        session()->setFlashdata('success','Komoditi Berhasil Di Lakukan Edit');
    }else{
        session()->setFlashdata('error','Komoditi Gagal Di Edit');
    }
    return $this->response->setJSON([
        'success'=>session()->getFlashdata('success'),
        'error'=>session()->getFlashdata('error')
    ]);
    
}
public function delete(){
    if(!$this->validate([
        'id'=>'required'
    ])){
        session()->setFlashdata('error','Data Inputan Yang Di Masukan Tidak Lengkap');
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error')
            ]);
    }
    $id= $this->request->getVar('id');
    $cek= $this->komoditi->delete($id);
    if($cek){
        session()->setFlashdata('success','Komoditi Berhasil Di Hapus');
        }else{
            session()->setFlashdata('error','Komoditi Gagal Di Hapus');
            }
            return $this->response->setJSON([
                'success'=>session()->getFlashdata('success'),
                'error'=>session()->getFlashdata('error')
                ]); 
}
}
