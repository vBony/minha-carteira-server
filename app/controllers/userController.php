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
        
        $this->sendJson($data);
    }
}