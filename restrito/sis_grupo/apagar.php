<?php
  include("../inc/autenticar.php");
  checkPerm("DELGRP");
  
  $codigo = $_REQUEST["codigo"];

$sql = "delete from sis_grupo where idgrupo = '$codigo'";

  if(!execQuery($sql))
  {
    echo "<script>alert('Nao foi possivel excluir este perfil. Esse registro pode estar em uso.');</script>";
  }
  else
  {
	logger("Perfil Exclu�do com Sucesso.");
  }

$txt = explode("?", $_SERVER['REQUEST_URI']);
$txt2 = explode("&", $txt[1]);
 
  
  //echo "<script>document.location='index.php';</script>";
  echo "<script>document.location='?".$txt2[0]."';</script>";

?>