<?php
  include("../inc/autenticar.php");
  
  checkPerm("DEAUSR");
  
  $idsecretaria  = $_REQUEST["idsecretaria"];
  $ativado  = $_REQUEST["ativado"];
	
  $sql = "UPDATE sis_secretaria set 
            ativado='$ativado', 
            idusuarioalteracao = ".getSession('uid').", 
            dataalteracao = NOW() 
          WHERE idsecretaria ='$idsecretaria' ";

  if (execQuery($sql))
  {
	if ($ativado == 0)
		logger("Desativou SIC");
	else
		logger("Ativou SIC");
		
	//header("Location: index.php");
	echo "javascript:history.go(-1)";
  }
  else
  {
	echo "<script>alert('Ocorreu um erro ao alterar status do SIC.');</script>";
  }
  
  echo "<script>history.go(-1);</script>";
?>