<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\InvoiceRumputlaut;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\InvoiceRumputLautModel;
class Invoice extends BaseController
{
    private $rumput;
    public function __construct()
    {
       
        $this->rumput= new InvoiceRumputLautModel();
    }
    public function index()
    {
        $data = [
            'invoice'=>$this->rumput->where('delete_mark', 0)->orderBy('kode_invoice', 'DESC')->findAll()
        ];
       // var_dump($data);
        return view('invoice/rumputlaut', $data);
    }
    public function getkode(){
        $data= $this->rumput->generateKodeInvoice();
   return $this->response->setJSON(['kode' => $data]);
    }
    public function tambah(){
        var_dump($_POST);
        if(!$this->validate([
            'kode_invoice' =>'required',
            'namapemanen'=>'required',
            'upah'=>'required',
            'jumlah'=>'required',
            'harga'=>'required'
        ])){
            session()->setFlashdata('error','Inputan Yang Di Masukan harap Di Lengkapi');
            return $this->response->setJSON([
                'error'=>session()->getFlashdata('error')
            ]);
        }
        $data=[
        'kode_invoice'=>$this->request->getVar('kode_invoice'),
        'namapemanen'=>$this->request->getVar('namapemanen'),
        'jumlah_upah'=>$this->request->getVar('upah'),
        'jumlah'=>$this->request->getVar('jumlah'),
        'harga'=>$this->request->getVar('harga'),
        'created_at'=>date('Y-m-d H:i:s')
        ];
        $cek= $this->rumput->save($data);
        if($cek){
            session()->setFlashdata('success','Data Berhasil Di Tambahkan');
        }else{
            session()->setFlashdata('error','Data Gagal Di Tambahkan');
        }
        return $this->response->setJSON([
            'success'=>session()->getFlashdata('success'),
            'error'=>session()->getFlashdata('error')
        ]);
    }
    public function cetak(){
        return view('invoice/cetak');
    }
}
