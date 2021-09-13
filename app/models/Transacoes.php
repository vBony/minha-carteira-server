<?php

class Transacoes extends modelHelper{
    private $tabela = "transacoes";
    public $errors;
    public $defaultMessage = "Campo obrigatório";

    public function inserir($params){
        $sql  = "INSERT INTO {$this->tabela} ";
        $sql .= "(tra_id, tra_tipo, tra_data, tra_descricao, tra_categoria, tra_valor, tra_situacao, tra_anexo, tra_usu_id, tra_mesano) ";
        $sql .= "VALUES ";
        $sql .= "(NULL, :tipo, :data, :descricao, :categoria, :valor, :situacao, NULL, :idUsuario, :mesano) ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":tipo", $params['tra_tipo']);
        $sql->bindValue(":data", $params['tra_data']);
        $sql->bindValue(":descricao", $params['tra_descricao']);
        $sql->bindValue(":categoria", $params['tra_categoria']);
        $sql->bindValue(":valor", $params['tra_valor']);
        if(isset($params['tra_situacao'])){
            $sql->bindValue(":situacao", 1);
        }else{
            $sql->bindValue(":situacao", 0);
        }
        $sql->bindValue(":idUsuario", $_SESSION['user_data']['usu_id']);
        $sql->bindValue(":mesano", $this->getMesano($params['tra_data']));

        $sql->execute();
    }

    private function getMesano($data){
        $dataArr = explode('-', $data);

        return $dataArr[1].$dataArr[0];
    }

    public function validate($params){
        if(isset($params['tra_valor'])){
            if(empty($params['tra_valor'])){
                $this->errors['tra_valor'] = $this->defaultMessage;
            }

            if($params['tra_valor'] <= 0){
                $this->errors['tra_valor'] = "Valor inválido";
            }
        }else{
            $this->errors['tra_valor'] = $this->defaultMessage;
        }

        if(isset($params['tra_data'])){
            
            if(empty($params['tra_data'])){
                $this->errors['tra_data'] = $this->defaultMessage;
            }

            $dataArr = explode('-', $params['tra_data']);
            if(count($dataArr) < 3){
                $this->errors['tra_data'] = "Data inválida";
            }else{
                if(!checkdate($dataArr[1], $dataArr[2], $dataArr[0])){
                    $this->errors['tra_data'] = "Data inválida";
                }
            }

            
        }else{
            $this->errors['tra_data'] = $this->defaultMessage;
        }

        if(isset($params['tra_categoria'])){
            if(empty($params['tra_categoria'])){
                $this->errors['tra_categoria'] = $this->defaultMessage;
            }

            if(intval($params['tra_categoria']) <= 0){
                $this->errors['tra_categoria'] = "Selecione uma categoria";
            }
        }else{
            $this->errors['tra_categoria'] = $this->defaultMessage;
        }

        if(isset($params['tra_descricao'])){
            if(empty($params['tra_descricao'])){
                $this->errors['tra_descricao'] = $this->defaultMessage;
            }

            if(strlen($params['tra_descricao']) > 150){
                $this->errors['tra_descricao'] = "Descrição muito longa";
            } 
        }else{
            $this->errors['tra_descricao'] = $this->defaultMessage;
        }

        if(!empty($this->errors)){
            return false;
        }else{
            return true;
        }
    }
}