<?php
require_once ("config.php");
//$sql = new SqL ();
//$usuarios=$sql->select("SELECT * from tb_usuarios");
//echo json_encode($usuarios);
//$root = new Usuario();
//carrega um usuario
//$root->loadbyId(3);
// echo $root; // aqui eu só consigo da um echo no objeto devido a função __toString no config.

//$lista = Usuario::getList(); // por ser uma função estatica pode ser chamada direta sem ser estanciada
//echo json_encode($lista);
//$search = Usuario::search("w"); // por ser uma função estatica pode ser chamada direta sem ser estanciada
//echo json_encode($search);
// carrega um usuário e senha válidos
//$usuario = new Usuario();
//$usuario->login("root","!@#$%");
//echo $usuario;

//inserindo
//$aluno = new Usuario("Aluno","12345"); //USANDO O CONSTRUCT

//$aluno->setDeslogin("Aluno"); // USANDO O SET.
//$aluno->setDessenha("12345");

//$aluno->insert();
//echo $aluno;
/*
// update de dados
$usuario = new Usuario();
$usuario->loadbyId(6);
$usuario->update("Erica","4321");
echo $usuario;
*/
// deletando
$usuario = new Usuario();
$usuario->loadbyId(6);
$usuario->delete();
echo $usuario;

?>