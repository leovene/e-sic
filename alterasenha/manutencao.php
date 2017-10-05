<?php
	include_once("../inc/autenticar.php");
	include_once("../class/solicitante.class.php");
	
	
	$erro   = "";	//grava o erro, se houver, e exibe por meio de alert (javascript) atraves da funcao getErro() chamada no arquivo do formulario. ps: a função é declara em inc/security.php


	//se tiver sido postado informação do formulario
	if($_POST['acao'])
	{

		$idsolicitante	= getSession("uid");
		$senhaatual	= $_POST["senhaatual"];
		$novasenha	= $_POST["novasenha"];
		$confirmasenha	= $_POST["confirmasenha"];

		
		$solicitante = new Solicitante();
		
		if (!$solicitante->alteraSenha($idsolicitante,$senhaatual,$novasenha,$confirmasenha))
			$erro = $solicitante->getErro();
		else
			echo "<script>location.href='".SITELNK."index.php';</script>";
		
		$solicitante = null;
	}


?>
