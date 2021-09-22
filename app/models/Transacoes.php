<?php

class Transacoes extends modelHelper{
    private $tabela = "transacoes";
    public $errors;
    public $defaultMessage = "Campo obrigatório";

    public function inserir($params, $idUsuario){
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
        $sql->bindValue(":situacao", $params['tra_situacao']);
        $sql->bindValue(":idUsuario", $idUsuario);
        $sql->bindValue(":mesano", $this->getMesano($params['tra_data']));

        $sql->execute();
    }

    public function buscar($idUser, $mesano){
        $mesano = $this->formatarMesAnoParaBanco($mesano);
        $sql  = " SELECT {$this->tabela}.*, cat_id, cat_descricao FROM {$this->tabela} "; 
        $sql .= " INNER JOIN categorias ON tra_categoria = cat_id ";
        $sql .= " WHERE tra_mesano = :mesano AND tra_usu_id = :idUser ORDER BY tra_id desc ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":mesano", $mesano);
        $sql->bindValue(":idUser", $idUser);
        $sql->execute();
        if($sql->rowCount() > 0){
            $transacoes = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($transacoes as $i => $transacao){
                $transacao['tra_data'] = date('d/m/Y', strtotime($transacao['tra_data']));
                $transacao['tra_valor'] = $this->floatParaReal($transacao['tra_valor']);

                $transacoes[$i] = $transacao;
            }

            return $transacoes;
        }
    }

    public function calcularReceitas($idUser, $mesano, $paraResposta = false){
        $tipo = 2;
        $mesano = $this->formatarMesAnoParaBanco($mesano);

        $sql  = " SELECT sum(tra_valor) as tra_valor"; 
        $sql .= " FROM transacoes";
        $sql .= " WHERE tra_usu_id = :idUser ";
        $sql .= " AND tra_tipo = :tipo ";
        $sql .= " AND tra_mesano = :mesano ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":idUser", $idUser);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":mesano", $mesano);
        $sql->execute();

        if($paraResposta){
            $valor = $sql->fetch(PDO::FETCH_ASSOC);
            return $this->floatParaReal( $valor['tra_valor'] );
        }
    }

    private function floatParaReal($num){
        if (strpos($num, "0") == 0){
            $num = str_replace(',', '.', $num);
            $num = number_format($num, 2, ',', '.');
            return $num;
        }else{
            $num = str_replace('.', '', $num);
            $num = str_replace(',', '.', $num);
            $num = number_format($num, 2, ',', '.');
            return $num;
        }
    }

    private function getMesano($data){
        $dataArr = explode('-', $data);

        return $dataArr[0].$dataArr[1];
    }

    private function formatarMesAnoParaBanco($mesano){
        $dataArr = explode('-', $mesano);

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