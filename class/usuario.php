<?php
class Usuario {
    private $idusario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    // após declarar os campos da tabela criar os Gets e Set para passagem dos valores 
    // Idusuario
    public function getIdusuario() {
        return $this->idusario;
    }
    public function setIdusuario($value) {
        $this->idusario=$value;
    }
    // deslogin
    public function getDeslogin() {
        return $this->deslogin;
    }
    public function setDeslogin($value) {
        $this->deslogin=$value;
    }
    // dessenha
    public function getDessenha() {
        return $this->dessenha;
    }
    public function setDessenha($value) {
        $this->dessenha=$value;
    }
    // dtcadastro
    public function getDtcadastro() {
        return $this->dtcadastro;
    }
    public function setDtcadastro($value) {
        $this->dtcadastro=$value;
    }
    // criando um metodo de carregamento
    public function loadbyId($id){
        $sql = new SqL ();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));
        if (count($results) > 0) {
            $row = $results[0];
            //pegar as linhas e passar os dados
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }

    }
    public function __toString() {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}

