<?php
class homeController extends controllerHelper{
    public function index(){
        $data = array();

        $data['css'] = 'home.css';
        $data['js'] = 'home.js';
        $data['title'] = "Minha carteira";
        
        $this->loadTemplate('home', $data);
    }

    public function home(){
        $data = array();

        $data['css'] = 'home.css';
        $data['js'] = 'home.js';

        $this->loadTemplate('home', $data);
    }
}

?>