<?php

class Transacoes extends modelHelper{
    private $tabela = "transacoes";
    public $errors;
    public $defaultMessage = "Campo obrigatório";
    private $id_receita = 2;
    private $id_despesa = 1;

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

    public function alterar($params, $idUsuario){
        $sql  = " UPDATE {$this->tabela} SET ";
        $sql .= " tra_data = :data, tra_descricao = :descricao, tra_categoria = :categoria, ";
        $sql .= " tra_valor = :valor, tra_situacao = :situacao, tra_mesano = :mesano ";
        $sql .= " WHERE tra_usu_id = :idUsuario AND tra_id = :id ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":data", $params['tra_data']);
        $sql->bindValue(":descricao", $params['tra_descricao']);
        $sql->bindValue(":categoria", $params['tra_categoria']);
        $sql->bindValue(":valor", $params['tra_valor']);
        $sql->bindValue(":situacao", $params['tra_situacao']);
        $sql->bindValue(":mesano", $this->getMesano($params['tra_data']));
        $sql->bindValue(":idUsuario", $idUsuario);
        $sql->bindValue(":id", $params['tra_id']);


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

    public function efetivar($id, $idUser){
        if(!empty($this->buscarPorId($id, $idUser))){
            $sql = " UPDATE {$this->tabela} SET tra_situacao = 1 WHERE tra_usu_id = :idUser AND tra_id = :id ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":idUser", $idUser);
            $sql->bindValue(":id", $id);
            $sql->execute();
            
            return true;
        }else{
            return false;
        }
    }

    public function deletar($id, $idUser){
        if(!empty($this->buscarPorId($id, $idUser))){
            $sql = " DELETE FROM {$this->tabela} WHERE tra_usu_id = :idUser AND tra_id = :id ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":idUser", $idUser);
            $sql->bindValue(":id", $id);
            $sql->execute();
            
            return true;
        }else{
            return false;
        }
    }

    public function buscarPorId($id, $idUsuario){
        $sql  = " SELECT {$this->tabela}.*, cat_id, cat_descricao FROM {$this->tabela} "; 
        $sql .= " INNER JOIN categorias ON tra_categoria = cat_id ";
        $sql .= " WHERE tra_usu_id = :idUser AND tra_id = :id";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":idUser", $idUsuario);
        $sql->execute();

        if($sql->rowCount() > 0){
            $transacao = $sql->fetch(PDO::FETCH_ASSOC);
            $transacao['tra_valor'] = $this->floatParaReal($transacao['tra_valor']);

            return $transacao;
        }else{
            return null;
        }
    }

    public function calcularResumosMes($idUser, $mesano){
        $receitasTotal = (float) $this->calcularTransacoes($idUser, $mesano, $this->id_receita);
        $despesasTotal = (float) $this->calcularTransacoes($idUser, $mesano, $this->id_despesa);

        $receitasSemPendentes = (float) $this->calcularTransacoes($idUser, $mesano, $this->id_receita, true);
        $despesasSemPendentes = (float) $this->calcularTransacoes($idUser, $mesano, $this->id_despesa, true);

        return[
            'saldo_atual' => $this->floatParaReal( $receitasSemPendentes - $despesasSemPendentes ),
            'receitas' => $this->floatParaReal( $receitasTotal ),
            'despesas' => $this->floatParaReal( $despesasTotal ),
            'saldo_mensal' => $this->floatParaReal( $receitasTotal - $despesasTotal ),
        ];
    }

    public function calcularTransacoes($idUser, $mesano, $tipo, $ignoraPendentes = false){
        $mesano = $this->formatarMesAnoParaBanco($mesano);

        $sql  = " SELECT sum(tra_valor) as tra_valor"; 
        $sql .= " FROM transacoes";
        $sql .= " WHERE tra_usu_id = :idUser ";
        if($ignoraPendentes){
            $sql .= " AND tra_situacao != 0 ";
        }
        $sql .= " AND tra_tipo = :tipo ";
        $sql .= " AND tra_mesano = :mesano ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":idUser", $idUser);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":mesano", $mesano);
        $sql->execute();

        $valor = $sql->fetch(PDO::FETCH_ASSOC);
            return $valor['tra_valor'];
    }

    private function floatParaReal($num){
        return number_format($num,2,",",".");
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