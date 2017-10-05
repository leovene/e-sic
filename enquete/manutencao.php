<?php
include_once("../inc/autenticar.php");
include_once("../class/solicitacao.class.php");

function validaDados()
{

	// Recuperamos os valores dos campos através do método POST
	global $erro;
	global $resposta;
	global $comentario;
	
	if (empty($resposta))
	{
		$erro = "Por favor selecione uma op��o de resposta!";
		return false;
	}
	
	return true;
}

$erro = "";
$resposta = $_POST["resposta"];
$comentario = $_POST["comentario"];

if ($_POST["Enviar"]) {

    if(validaDados())
    {
        $sql="INSERT INTO lda_enquete
                (idsolicitante, resposta, comentario, dataresposta)
                VALUES
                (".getSession("uid").", '".$resposta."','".(str_replace("'","\'",$comentario))."',NOW())";

        if (!execQuery($sql))
            $erro = "Erro ao gravar enquete";

    }
}

?>