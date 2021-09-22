<?php
class dashboardController extends controllerHelper{
    public function index(){
        $data = array();
        $request = $_POST;

        $Sessao = new Sessao();
        $Usuario = new Usuario();

        if(!empty($request['access_token']) && $Sessao->validarToken($request['access_token'])){
            $sessao = $Sessao->buscarValidoPorToken($request['access_token']);

            $mesano = date('m-Y');

            $data['user'] = $Usuario->safeData($Usuario->buscar($sessao['ss_usu_id']));
            $data['access_token'] = $sessao['ss_token'];
            $data['mesanos'] = [
                'mes_ano' => $mesano,
                'prox_mesano' => $this->getMesAno($mesano, 'after'),
                'ant_mesano' =>  $this->getMesAno($mesano, 'before')
            ];

            $this->sendJson(['data' => $data]);
        }else{
            return http_response_code(401);
        }
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
        $Sessao = new Sessao();
        $Usuario = new Usuario();

        $data = $_POST['data'];
        $mesano = $_POST['mesano'];
        $access_token = isset($_POST['access_token']) && !empty($_POST['access_token']) ? $_POST['access_token'] : null;

        if(empty($access_token) && !$Sessao->validarToken($access_token)){
            return http_response_code(401);
        }

        $sessao = $Sessao->buscarValidoPorToken($access_token);
        $usuario = $Usuario->buscar($sessao['ss_usu_id']);
        $sessao = $Sessao->setSessao($usuario['usu_id']);

        $data['tra_valor'] = isset($data['tra_valor']) && !empty($data['tra_valor']) ? $this->changeToFloat($data['tra_valor']) : null;

        if(!$Transacoes->validate($data)){
            $this->sendJson(array("errors" => $Transacoes->errors));
        }else{
            $Transacoes->inserir($data, $usuario['usu_id']);
            $transacoes = $Transacoes->buscarPorMesano($usuario['usu_id'], $mesano);

            $this->sendJson([
                'access_token' => $sessao['ss_token'],
                'transacoes' => $transacoes,
            ]);
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