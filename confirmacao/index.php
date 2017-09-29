<?php
/**********************************************************************************
 Sistema e-SIC Livre: sistema de acesso a informa��o baseado na lei de acesso.
 
 Copyright (C) 2014 Prefeitura Municipal de Piracaia
 
 Este programa � software livre; voc� pode redistribu�-lo e/ou
 modific�-lo sob os termos da Licen�a GPL2.
***********************************************************************************/

	require_once("../class/solicitante.class.php");
	
	$idsolicitantecripto = $_GET['k'];
	$msg="";
	$solicitante = new Solicitante();
	
	if (!$solicitante->confirmaCadastro($idsolicitantecripto))
		$msg = "<br>".$solicitante->getErro();
	else
		$msg = "<br>Prezado(a) ".$solicitante->getNome().", a confirma&ccedil;&atilde;o de cadastro foi realizada com sucesso. <br><br>Lembrando que seu usu&aacute;rio no sistema &eacute; o seu documento cadastrado: <b>".$solicitante->getCpfCnpj()."</b>.";

	$solicitante = null;
	
	include_once("../inc/topo.php");

	echo "<h1>Confirma&ccedil;&atilde;o de Cadastro</h1>";
	
	echo $msg."<br><br>&nbsp;";

	include_once("../inc/rodape.php");	
?>



