<?php
  include("../inc/autenticar.php");
  checkPerm("DELPARAM");
  
  $codigo = $_REQUEST["codigo"];

  $sql = "delete from sis_param where sistema = '$codigo'";

  if(!execQuery($sql))
  {
    echo "<script>alert('Nao foi possivel excluir este PARAMETRO. Esse registro pode estar em uso.');</script>";
  }
  else
  {
	logger("PARAMETRO Ecluído com Sucesso.");
  }

  echo "<script>document.location='index.php';</script>";

?>