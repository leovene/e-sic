<?php
  include("../inc/autenticar.php");
  checkPerm("DELTIPOSOL");
  
  $codigo = $_REQUEST["codigo"];

  $sql = "delete from lda_tiposolicitacao where idtiposolicitacao = '$codigo'";

  if(!execQuery($sql))
  {
    echo "<script>alert('Não foi possivel excluir este tipo de solicitação. Esse registro pode estar em uso.');</script>";
  }
  else
  {
	logger("Tipo de solicitação excluído com sucesso.");
  }

  echo "<script>document.location='?lda_tiposolicitacao';</script>";

?>