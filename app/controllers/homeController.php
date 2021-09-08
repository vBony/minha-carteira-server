<?php
class homeController extends controllerHelper{
    public function index(){
        $this->privatePage();

        $data = array();

        $data['css'] = 'home.css';
        $data['js'] = 'home.js';
        $data['title'] = "Minha carteira";
        
        $this->loadTemplate('home', $data);
    }
}

?>