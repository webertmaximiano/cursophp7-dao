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
           // $row = $results[0];
            //pegar as linhas e passar os dados
           // $this->setIdusuario($row['idusuario']);
           // $this->setDeslogin($row['deslogin']);
           // $this->setDessenha($row['dessenha']);
            //$this->setDtcadastro(new DateTime($row['dtcadastro']));
            $this->setData($results[0]);
        }

    }

    public static function getList(){
        $sql = new SqL();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

    }

    public static function search ($Login){
        $sql = new SqL();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
        ':SEARCH'=>"%".$Login."%"
        ));
    }

    public function login ($Login,$password){
        $sql = new SqL ();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$Login,
            ":PASSWORD"=>$password
        ));
        if (count($results) > 0) {
            $this->setData($results[0]);
           // $row = $results[0];
            //pegar as linhas e passar os dados
           // $this->setIdusuario($row['idusuario']);
           // $this->setDeslogin($row['deslogin']);
           // $this->setDessenha($row['dessenha']);
           // $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }else {
            throw new Exception("Login ou Senha inválidos");
        }
    }

    public function setData($data){
// seta os dados do bd
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));

    }

    public function insert(){
        $sql = new SqL ();

        $results = $sql->select("CALL sp_usuarios_insert (:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(), 
            ':PASSWORD'=>$this->getDessenha()
        ));
        if (count($results) > 0){
            $this->setData($results[0]);
        }
    }

    public function update($Login, $password){

        $this->setDeslogin($Login);
        $this->setDessenha($password);


        $sql = new SqL ();
        $sql->query ("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha =:PASSWORD WHERE idusuario =:ID", array(
            ':LOGIN'=>$this->getDeslogin(), 
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));
    }

    public function delete(){
        $sql = new SqL (); // instancia do Bd
        $sql->query ("DELETE tb_usuarios WHERE idusuario =:ID", array(
              ':ID'=>$this->getIdusuario()
        ));
        
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
    }

    public function __construct($Login = "",$password =""){ //AS ASPAS VAZIAS É PRA NAO DA ERRO SE DEIXAR EM BRANCO OS DADOS
     
        $this->setDeslogin($Login);

        $this->setDessenha($password);

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

