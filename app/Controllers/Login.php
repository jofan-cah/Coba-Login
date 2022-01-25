<?php

namespace App\Controllers;


class Login extends BaseController
{
    private $googleClient = NULL;
    public function __construct()
    {
        session();
        require_once APPPATH . "libraries/vendor/autoload.php";
        $this->googleClient = new \Google_Client();
        $this->googleClient->setClientId("526050454044-a6j0g4l2aepd37qvjou8hdr7q528aham.apps.googleusercontent.com");
        $this->googleClient->setClientSecret("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");
        $this->googleClient->setRedirectUri("http://localhost:8080/login/");
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");
    }
    public function index()
    {
        // Nangkep Kode di URL
        $code = isset($_GET['code']) ? $_GET['code'] : NULL;
        if ($code == '') {
            $data = [
                'title' => 'LPJ',
                'subtitle' => 'HMPTI UDB',
                'googleButton' => $this->googleClient->createAuthUrl(),
            ];
            return view('login', $data);
        } else {
            $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
            $googleService = new \Google_Service_Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();
            $currentDateTime = date("Y-m-d H:i:s");
            //set Session Google
            $userdata = [
                'name' => $data['givenName'] . " " . $data['familyName'],
                'email' => $data['email'],
                'profile_img' => $data['picture'],
                'updated_at' => $currentDateTime
            ];
            session()->set("LoggedUserData", $userdata);
            $email = session()->get("LoggedUserData")['email'];
          
            session()->setFlashData("msg", 'success#Selamat datang, ' .  '. Anda kini dapat mendaftar event memakai akun ini.');
            return view('v_login', $userdata);
        }
        // }
    }
    public function keluar()
    {
        session()->remove('LoggedUserData');
        session()->remove('AccessToken');

        session()->setFlashData("msg", 'error#Anda Berhasil Keluar');
        return redirect()->to(base_url('/login'));
    }
}
