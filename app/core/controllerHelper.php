<?php
class controllerHelper{

    /**
     * Validações ou funções que precisam ser executadas em todas as paginas
     */
    public function __construct(){
        $this->incluirIpRelatorio();
    }

    public function loadView($viewName, $viewData = array(), $show_header = true){
        extract($viewData);

        require 'app/views/'.$viewName.'.php';
    }

    public function loadTemplate($viewName, $viewData = array(), $show_header = true){
        extract ($viewData);

        require 'app/views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'app/views/'.$viewName.'.php';
    }



    /**
     * Adiciona o IP do usuário no relatorio de acessos
     */
    public function incluirIpRelatorio(){
        if($_ENV['ENVIROMENT'] == 'homolog'){
            $RelatorioAcessos = new RelatorioAcessos();
            $ip = $_SERVER["REMOTE_ADDR"];

            
            $ultimo_acesso = $RelatorioAcessos->getUltimoAcesso($ip);
            if(!empty($ultimo_acesso)){
                $data_hora = $ultimo_acesso['ra_data_hora'];
                $valido_ate = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($data_hora)));
                $now = date('Y-m-d H:i:s');

                if(strtotime($now) > strtotime($valido_ate)){
                    $RelatorioAcessos->incluir($ip);
                }
            }else{
                $RelatorioAcessos->incluir($ip);
            }
            
        }
    }
}

?>