<?php

class Usuario extends modelHelper{
    private $tabela = "usuario";
    public $errors;


    public function cadastrar($params){
        $sql  = "INSERT INTO {$this->tabela} ";
        $sql .= "(usu_id, usu_nome, usu_sobrenome, usu_profissao, usu_senha, usu_data_criacao, usu_excluido, usu_email, usu_foto, usu_token) ";
        $sql .= "VALUES ";
        $sql .= "(NULL, :nome, :sobrenome, :profissao, :senha, :dataCriacao, 0, :email, NULL, NULL) ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", $params['usu_nome']);
        $sql->bindValue(":sobrenome", $params['usu_sobrenome']);
        $sql->bindValue(":profissao", $params['usu_profissao']);
        $sql->bindValue(":senha", password_hash($params['usu_senha'], PASSWORD_DEFAULT));
        $sql->bindValue(":dataCriacao", date('Y-m-d'));
        $sql->bindValue(":email", $params['usu_email']);

        $sql->execute();
    }

    public function buscarPorEmail($email){
        $sql = "SELECT * FROM {$this->tabela} WHERE usu_email = :email";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $sql->fetch();
        }
    }

    public function validate($params){
        $defaultMessage = "Campo obrigatório";
        
        // usu_nome
        if(isset($params['usu_nome'])){
            if(strlen($params['usu_nome']) > 80){
                $this->errors['usu_nome'] = $defaultMessage;
            }

            if(empty($params['usu_nome'])){
                $this->errors['usu_nome'] = $defaultMessage;
            }
        }else{
            $this->errors['usu_nome'] = $defaultMessage;
        }


        // usu_sobrenome
        if(isset($params['usu_sobrenome'])){
            if(strlen($params['usu_sobrenome']) > 80){
                $this->errors['usu_sobrenome'] = $defaultMessage;
            }
        }


        // usu_email
        if(isset($params['usu_email'])){
            if(!filter_var($params['usu_email'], FILTER_VALIDATE_EMAIL)){
                $this->errors['usu_email'] = "E-mail inválido";
            }   

            if(empty($params['usu_email'])){
                $this->errors['usu_email'] = $defaultMessage;
            }
        }else{
            $this->errors['usu_email'] = $defaultMessage;
        }


        // usu_senha
        if(isset($params['usu_senha'])){
            if(empty($params['usu_senha'])){
                $this->errors['usu_senha'] = $defaultMessage;
            }

            if(isset($params['repita_senha'])){
                if($params['repita_senha'] != $params['usu_senha']){
                    $this->errors['usu_senha'] = "Os campos não coincidem";
                }
            }
        }else{
            $this->errors['usu_senha'] = $defaultMessage;
        }

        if(!empty($this->errors)){
            return false;
        }else{
            return true;
        }
    }
}


?>