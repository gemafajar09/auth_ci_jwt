<?php

use Firebase\JWT\JWT;

class Logincontroller extends CI_Controller {
    private $key = 'MiSEXeB9QEBT7Icoxn4tGa6NmxfjA8mbjPhWpiMmEMFkac7thHAMdkjqQuB4YqBF';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('loginmodel');
    }

    // method untuk melihat token pada user
    public function login()
    {
        $waktu = new DateTime();
        $username = $_POST['username']; 
        $pass = $_POST['password']; 
        $user = $this->loginmodel->cekDataUser($username);
        if ($user) {
            if (password_verify($pass,$user->password)) {
                $payload['id'] = $user->id_user;
                $payload['username'] = $user->username;
                $payload['iat'] = $waktu->getTimestamp(); //waktu di buat
                $payload['exp'] = $waktu->getTimestamp() + 3600; //satu jam
                $token = JWT::encode($payload,$this->key);
                echo json_encode(['data' => $user, 'token' =>$token]);
            } else {
                $this->tokensalah($username);
            }
        } else {
            $this->tokensalah($username);
        }
    }

    // method untuk jika generate token diatas salah
    public function tokensalah($username)
    {
        echo json_encode([
          'status' => FALSE,
          'username' => $username,
          'message' => 'Invalid!'
          ]);
    }

    // method untuk mengecek token setiap melakukan post, get
    public function cektoken()
    {
        $this->load->model('loginmodel');
        $jwt = $this->input->get_request_header('Authorization');
        try {
            $decode = JWT::decode($jwt,$this->key,array('HS256'));
            if ($this->loginmodel->cekJikaAda($decode->username)>0) {
                return true;
            }
        } catch (Exception $e) {
            exit('Token Kadarluwasa');
        }
    }

}
?>