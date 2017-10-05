<?php
  include("../inc/autenticar.php");
  checkPerm("DELSEC");
  
  $codigo = $_REQUEST["codigo"];

  $sql = "delete from sis_secretaria where idsecretaria = '$codigo'";

  if(!execQuery($sql))
  {
    echo "<script>alert('Nao foi possivel excluir este SIC. Esse registro pode estar em uso.');</script>";
  }
  else
  {
	logger("Excluiu SIC");
	
  }

  echo "<script>document.location='?sis_secretaria';</script>";

?>