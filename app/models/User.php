<?php
class User extends modelHelper{

    //Verifica se o usuário já possui uma conta com o facebook vinculado
    public function facebookVerifier($fbid, $email){
        $sql = 'SELECT * FROM users WHERE fb_id = :fbid AND email = :email';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':fbid', $fbid);
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            foreach ($sql as $dados);
            return $dados;
        }else{
            return false;
        }

    }

    //Cadastra o usuário que se conectou pelo facebook.
    public function facebookRegister($FBid, $FBemail, $FBname){
        $sql = 'INSERT INTO users(id, fb_id, email, username, password, first_access) VALUES (NULL, :fbid, :email, :username, NULL, 1)'; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':fbid', $FBid);
        $sql->bindValue(':email', $FBemail);
        $sql->bindValue(':username', $FBname);
        $sql->execute();
    }
}


?>