<?php

class Sessao extends modelHelper{
    private $tabela = "sessao";
    public $errors;

    public function buscar($id){
        $sql = " SELECT * FROM {$this->tabela} WHERE ss_id = :id ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdUsuario($idUsuario){
        $sql = " SELECT * FROM {$this->tabela} WHERE ss_usu_id = :idUser ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":idUser", $idUsuario);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $sql->fetch(PDO::FETCH_ASSOC);
        }else{
            return null;
        }
    }

    public function setSessao($idUser){
        $token = md5($idUser . date('Y-m-d H:i:s') . rand());
        $data = (string) strtotime(date('Y-m-d H:i:s', strtotime("+3 hours")));
        $ip = password_hash($this->getIpAddress(), PASSWORD_BCRYPT);
        
        $user = $this->buscarPorIdUsuario($idUser);
        if(!empty($user)){
            $sql  = " UPDATE {$this->tabela} ";
            $sql .= " SET ";
            $sql .= " ss_token = :token, ss_valido_ate = :data, ss_endereco = :ip ";
            $sql .= " WHERE ss_usu_id = :idUser ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":token", $token);
            $sql->bindValue(":data", $data);
            $sql->bindValue(":ip", $ip);
            $sql->bindValue(":idUser", $user['ss_usu_id']);
            $sql->execute();

            return $this->buscarPorIdUsuario($user['ss_usu_id']);
        }else{
            $sql  = "INSERT INTO sessao(ss_id, ss_usu_id, ss_token, ss_valido_ate, ss_endereco) ";
            $sql .= "VALUES (NULL, :idUser, :token, :data, :ip)";
            
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":idUser", $idUser);
            $sql->bindValue(":token", $token);
            $sql->bindValue(":data", $data);
            $sql->bindValue(":ip", $ip);
            $sql->execute();
            
            $id = $this->db->lastInsertId();
            
            return $this->buscar($id);
        }
    }

    public function buscarValidoPorToken($token){
        $dataAtual = strtotime(date('Y-m-d H:i:s'));
        $ip = $this->getIpAddress();

        $sql  = " SELECT * FROM {$this->tabela} ";
        $sql .= " WHERE ss_token = :token ";
        $sql .= " AND ss_valido_ate > :dataAtual ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":token", $token);
        $sql->bindValue(":dataAtual", $dataAtual);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sessao = $sql->fetch(PDO::FETCH_ASSOC);
            if(password_verify($ip, $sessao['ss_endereco'])){
                return $sessao;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function validarToken($token){
        $token = $this->buscarValidoPorToken($token);

        if($token != null){
            return true;
        }else{
            return false;
        }
    }
}