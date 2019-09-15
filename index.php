<?php
require_once ("config.php");
$sql = new SqL ();
$usuarios=$sql->select("SELECT * from tb_usuarios");

echo json_encode($usuarios);

?>