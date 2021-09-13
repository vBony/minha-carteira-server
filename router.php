<?php
global $routes;
$routes = array();
$routes['/criar-conta'] = '/user/criarConta';
$routes['/api/criar-conta'] = '/user/register';
$routes['/login'] = '/user/login';
$routes['/api/login'] = '/user/loginApi';
$routes['/api/inserir-receita'] = '/home/inserirReceita';