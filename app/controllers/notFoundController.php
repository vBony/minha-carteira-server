<?php

class notFoundController extends controllerHelper{
    public function index(){
        $data = array();

        $this->loadView('not-found', $data);
    }

    public function home(){
        $data = array();

        $data['css'] = 'home.css';
        $data['js'] = 'home.js';

        $this->loadTemplate('home', $data);
    }
}