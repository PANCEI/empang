<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use BadFunctionCallException;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
class Login extends BaseController
{
    private $user;
    public function __construct(){
        $this->user = new UserModel();
    }
    public function index()
    {
        return view('Login/index');
    }
    public function masuk(){
       $cek=$this->user->getEmail($this->request->getVar('email'));
      // var_dump($cek);
        if(!$this->validate([
            'email'=>'valid_email|required',
            'password'=>'required',
        ])){
            session()->setFlashdata('error','Inputan Yang Anda Masukan Tidak Lengkap');
            return $this->response->setJSON([
                'error' => session()->getFlashdata('error')
            ]);
        }
        if($cek){
            $password = $this->request->getVar('password');
            if(password_verify($password, $cek['password'])){
                if($cek['aktif']==1){
                    $data = [
                        "id_user" => $cek['id_user'],
                        'username' => $cek['username']
                    ];
                    session()->set($data);
                    session()->setFlashdata('success','Anda Berhasil Login');
                }else{
                    session()->setFlashdata('error','Akun Anda Belum Aktif');
                }
            }else{
                session()->setFlashdata('error','Password Salah');
            }
        }else{
            session()->setFlashdata('error','Email Anda Belum Terdaftar');
        }
        return $this->response->setJSON([
            'error'=>session()->getFlashdata('error'),
            'success'=>session()->getFlashdata('success')
        ]);
    }
}
