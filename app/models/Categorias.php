<?php

class Categorias extends modelHelper{
    private $tabela = 'categorias';
    public $errors;
    public $defaultMessage = "Campo obrigatório";

    public function buscar($tipo){
        $sql = "SELECT * FROM {$this->tabela} WHERE cat_tipo = :tipo";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":tipo", $tipo);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    
}