<?php
require_once ("config.php");
//$sql = new SqL ();
//$usuarios=$sql->select("SELECT * from tb_usuarios");
//echo json_encode($usuarios);
$root = new Usuario();

$root->loadbyId(3);

echo $root; // aqui eu só consigo da um echo no objeto devido a função __toString no config.

?>