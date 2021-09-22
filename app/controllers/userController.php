<?php

class userController extends controllerHelper{
    public function profile($id){
        $data = array();
        $data['id'] = $id;

        $this->loadTemplate('user-profile', $data);
    }

    public function criarConta(){
        $data = array();
        $data['base_url'] = $_ENV['BASE_URL'];

        $this->loadView('cadastro', $data);
    }

    public function register(){
        $Usuario = new Usuario();
        $data = $_POST;

        if(!$Usuario->validate($data)){
            $this->sendJson(array("errors" => $Usuario->errors));
        }else{
            if(!empty($Usuario->buscarPorEmail($data['usu_email']))){
                $this->sendJson(array("errors" => ['usu_email' => "Já existe uma conta cadastrada com esse e-mail"]));
            }else{
                $Usuario->cadastrar($data);
                $this->sendJson(array('messages' => 'success'));
            }
        }
    }

    public function login(){
        $Usuario = new Usuario();
        $Sessao = new Sessao();
        $data = $_POST['data'];

        if(!$Usuario->login($data)){
            $this->sendJson(array("errors" => $Usuario->errors));
        }else{  
            $user = $Usuario->login($data);

            $sessao = $Sessao->setSessao($user['usu_id']);

            $this->sendJson([
                'access_token' => $sessao['ss_token']
            ]);
        }
    }
}