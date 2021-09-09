<?php
class homeController extends controllerHelper{
    public function index(){
        $this->privatePage();

        $data = array();

        $data['css'] = 'home.css';
        $data['js'] = 'home.js';
        $data['title'] = "Minha carteira";
        $data['user_data'] = $_SESSION['user_data'];
        $data['base_url'] = $_ENV['BASE_URL'];
        
        $this->loadTemplate('home', $data);
    }
}

?>