<?php
	include_once("../class/solicitante.class.php");
	
	
	
	$erro="";
	
	if($_POST['btsub'])
	{
		$cpfcnpj = $_POST['cpfcnpj'];
		
		$solicitante = new Solicitante();
		
		if (!$solicitante->resetaSenha($cpfcnpj))
			$erro = $solicitante->getErro();
		else
			$erro = "Caro(a) ".$solicitante->getNome().", sua senha foi redefinida com sucesso. A nova senha foi enviada para o seu e-mail: ".$solicitante->getEmail();

		$solicitante = null;
	}
?>

