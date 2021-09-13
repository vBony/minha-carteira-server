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

        if(!isset($_GET['mesano']) || !$this->validarMesAno($_GET['mesano'])){
            $data['mes_ano'] = date('m-Y');
            $data['prox_mesano'] = $this->getMesAno($data['mes_ano'], 'after');
            $data['ant_mesano'] = $this->getMesAno($data['mes_ano'], 'before');
        }else{
            $data['mes_ano'] = $_GET['mesano'];
            $data['prox_mesano'] = $this->getMesAno($data['mes_ano'], 'after');
            $data['ant_mesano'] = $this->getMesAno($data['mes_ano'], 'before');
        }

        $this->loadTemplate('home', $data);
    }

    public function categorias(){
        $Categorias = new Categorias();
        if(isset($_POST['tipo']) && !empty($_POST['tipo'])){
            $tipo = $_POST['tipo'];
            $data['categorias'] = $Categorias->buscar($tipo);

            $this->sendJson($data);
        }
    }

    public function inserirReceita(){
        $Transacoes = new Transacoes();

        $data = $_POST;

        $data['tra_valor'] = isset($data['tra_valor']) && !empty($data['tra_valor']) ? $this->changeToFloat($data['tra_valor']) : null;

        if(!$Transacoes->validate($data)){
            $this->sendJson(array("errors" => $Transacoes->errors));
        }else{
            $Transacoes->inserir($data);
            $this->sendJson(array('messages' => 'success'));
        }
    }

    private function changeToFloat($value){
        return (float) number_format(str_replace(",",".",str_replace(".","",$value)), 2, '.', '');
    }

    private function validarMesAno($ma){
        if(empty($ma)){
            return false;
        }else{
            $mesAno = $ma;
            $mesAnoArr = explode("-", $mesAno);

            if(count($mesAnoArr) == 2){
                $mes = $mesAnoArr[0];
                $ano = $mesAnoArr[1];

                if(!checkdate($mes, 01, $ano)){
                    return false;
                }else{
                    return $ma;
                }
            }
        }
    }

    private function getMesAno($mesano, $action){
        $mesanoArr = explode('-', $mesano);
        $mes = (int) $mesanoArr[0];
        $ano = (int) $mesanoArr[1];

        if($action == 'before'){
            if($mes == 1){
                $ano = $ano - 1;
                $mes = 12;

            }else{
                $mes = $mes - 1;
                if($mes < 10){
                    $mes = '0'.$mes;
                }
            }

            return $mes . '-' . $ano;
        }

        if($action == 'after'){
            if($mes == 12){
                $mes = '01';
                $ano = $ano + 1;
            }else{
                $mes = $mes + 1;
                if($mes < 10){
                    $mes = '0'.$mes;
                }
            }
            return $mes . '-' . $ano;
        }

    }
}

?>