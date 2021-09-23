<?php
global $routes;
$routes = array();
$routes['/user/criar-conta'] = '/user/register';
$routes['/login'] = '/user/login';
$routes['/api/login'] = '/user/loginApi';
$routes['/dashboard/inserir-transacao'] = '/dashboard/inserirTransacao';