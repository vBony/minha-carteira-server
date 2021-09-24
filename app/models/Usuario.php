<?php

class Usuario extends modelHelper{
    private $tabela = "usuario";
    public $errors;
    public $defaultMessage = "Campo obrigatório";

    public function buscar($id){
        $sql = "SELECT * FROM {$this->tabela} WHERE usu_id = :id";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function cadastrar($params, $retornarId = false){
        $sql  = "INSERT INTO {$this->tabela} ";
        $sql .= "(usu_id, usu_nome, usu_sobrenome, usu_profissao, usu_senha, usu_data_criacao, usu_excluido, usu_email, usu_foto) ";
        $sql .= "VALUES ";
        $sql .= "(NULL, :nome, :sobrenome, :profissao, :senha, :dataCriacao, 0, :email, NULL) ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", $params['usu_nome']);
        $sql->bindValue(":sobrenome", $params['usu_sobrenome']);
        $sql->bindValue(":profissao", $params['usu_profissao']);
        $sql->bindValue(":senha", password_hash($params['usu_senha'], PASSWORD_DEFAULT));
        $sql->bindValue(":dataCriacao", date('Y-m-d'));
        $sql->bindValue(":email", $params['usu_email']);
        $sql->execute();

        if($retornarId){
           return $this->db->lastInsertId();
        }else{
            return true;
        }
    }

    public function buscarPorEmail($email){
        $sql = "SELECT * FROM {$this->tabela} WHERE usu_email = :email";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function login($params){
        if(isset($params['usu_email'])){
            if(!filter_var($params['usu_email'], FILTER_VALIDATE_EMAIL)){
                $this->errors['usu_email'] = "E-mail inválido";
            }   

            if(empty($params['usu_email'])){
                $this->errors['usu_email'] = $this->defaultMessage;
            }
        }else{
            $this->errors['usu_email'] = $this->defaultMessage;
        }

        if(isset($params['usu_senha'])){
            if(empty($params['usu_senha'])){
                $this->errors['usu_senha'] = $this->defaultMessage;
            }
        }else{
            $this->errors['usu_senha'] = $this->defaultMessage;
        }

        if(empty($this->errors)){
            $userFound = $this->buscarPorEmail($params['usu_email']);
            if(empty($userFound)){
                $this->errors['usu_email'] = "E-mail não encontrado";
                return false;
            }else{
                if(password_verify($params['usu_senha'], $userFound['usu_senha'])){
                    return $this->safeData($userFound);
                }else{
                    $this->errors['usu_senha'] = "Senha incorreta";
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    public function safeData($params){
        unset($params['usu_senha']);
        unset($params['usu_excluido']);
        unset($params['usu_token']);

        return $params;
    }

    public function validate($params){
        
        // usu_nome
        if(isset($params['usu_nome'])){
            if(strlen($params['usu_nome']) > 80){
                $this->errors['usu_nome'] = $this->defaultMessage;
            }

            if(empty($params['usu_nome'])){
                $this->errors['usu_nome'] = $this->defaultMessage;
            }
        }else{
            $this->errors['usu_nome'] = $this->defaultMessage;
        }


        // usu_sobrenome
        if(isset($params['usu_sobrenome'])){
            if(strlen($params['usu_sobrenome']) > 80){
                $this->errors['usu_sobrenome'] = $this->defaultMessage;
            }
        }


        // usu_email
        if(isset($params['usu_email'])){
            if(!filter_var($params['usu_email'], FILTER_VALIDATE_EMAIL)){
                $this->errors['usu_email'] = "E-mail inválido";
            }   

            if(empty($params['usu_email'])){
                $this->errors['usu_email'] = $this->defaultMessage;
            }
        }else{
            $this->errors['usu_email'] = $this->defaultMessage;
        }


        // usu_senha
        if(isset($params['usu_senha'])){
            if(empty($params['usu_senha'])){
                $this->errors['usu_senha'] = $this->defaultMessage;
            }
        }else{
            $this->errors['usu_senha'] = $this->defaultMessage;
        }

        if(!empty($this->errors)){
            return false;
        }else{
            return true;
        }
    }
}


?>