<?php
  include("../inc/autenticar.php");
  
  checkPerm("DEAUSR");
  
  $idusuario  = $_REQUEST["idusuario"];
  $status  = $_REQUEST["status"];
	
  $sql = "UPDATE sis_usuario set 
            status='$status', 
            idusuarioalteracao = ".getSession('uid').", 
            dataalteracao = NOW() 
          WHERE idusuario ='$idusuario' ";

  if (execQuery($sql))
  {
	if ($status == "I")
		logger("Desativou Usuario");
	else
		logger("Ativou Usuario");
		
	//header("Location: index.php");
	echo "javascript:history.go(-1)";
  }
  else
  {
	echo "<script>alert('Ocorreu um erro ao alterar status do usuario.');</script>";
  }
  
  echo "<script>history.go(-1);</script>";
?>