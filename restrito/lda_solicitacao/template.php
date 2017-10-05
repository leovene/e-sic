<?php
include("../inc/autenticar.php");
checkPerm("LSTLDASOLICITACAO");

$varAreaRestrita = "leideacesso"; //indica se deve ser incluido o arquivo dentro da classe

include("../inc/paginacaoPorPostIni.php");

$filtro = "";

$numprotocolo   = $_REQUEST["fltnumprotocolo"];
$solicitante    = $_REQUEST["fltsolicitante"];
$situacao       = $_REQUEST["fltsituacao"];
$idSecretariaUsuario = getSession('idsecretaria');

$parametrosIndex = "fltnumprotocolo=$numprotocolo&fltsolicitante=$solicitante&fltsituacao=$situacao"; //parametros a ser passado para a pagina de detalhamento, fazendo com que ao voltar para o index traga as informa��es passadas anteriormente

if (!empty($numprotocolo)) $filtro.= " and concat(sol.numprotocolo,'/',sol.anoprotocolo) = '$numprotocolo'";
if (!empty($solicitante)) $filtro.= " and pes.nome like '%$solicitante%'";

//verifica se a secretaria do usuario � um SIC central
$sql="select sigla from sis_secretaria where siccentral = 1 and idsecretaria = '$idSecretariaUsuario'";
$rs=  execQuery($sql);
$visibilidadeSICcentral = mysqli_num_rows($rs)>0;

//se usuario pertencer a um SIC central
if($visibilidadeSICcentral)
    $filtro.= " and ifnull(secDestino.idsecretaria,'$idSecretariaUsuario') = '$idSecretariaUsuario' ";
else
{
    //caso exista SIC centralizador, s� mostra as solicita��es do SIC do usuario
    if(Solicitacao::existeSicCentralizador())
        $filtro.= " and secDestino.idsecretaria = '$idSecretariaUsuario'"; //filtra so as que a ultima movimenta��o tem como destino a secretaria do usuario
    else
        $filtro.= " and (secDestino.idsecretaria = '$idSecretariaUsuario' or (sol.idsecretariaselecionada = '$idSecretariaUsuario' and sol.situacao = 'A'))"; //filtra so as que a ultima movimenta��o tem como destino a secretaria do usuario ou que a secretaria selecionada tenha sido a do usuario e o status esteja em aberto
}



//seleciona as solicita��es n�o respondidas e sua ultima movimenta��o (recupera variaveis de configuracao de prazos)
/*
 * Quando a situa��o for A ou T, trata da primeira tramita��o do processo. 
 */
$sql = "select sol.*, 
               pes.nome as solicitante,
               ifnull(secOrigem.sigla,'Solicitante') as secretariaorigem, 
               case when secDestino.sigla is null then
                        ifnull(secSelecionada.sigla,'SIC Central')
               else 'SIC Central'
               end as secretariadestino, 
               mov.idsecretariadestino,
               mov.datarecebimento,
               mov.idmovimentacao,
               c.*,
               DATEDIFF(sol.dataprevisaoresposta, NOW()) as prazorestante,
               tip.nome as instancia

        from lda_solicitacao sol
        join lda_tiposolicitacao tip on tip.idtiposolicitacao = sol.idtiposolicitacao
        join lda_solicitante pes on pes.idsolicitante = sol.idsolicitante
        left join lda_movimentacao mov on mov.idmovimentacao = (select max(m.idmovimentacao) from lda_movimentacao m where m.idsolicitacao = sol.idsolicitacao)
        left join sis_secretaria secOrigem on secOrigem.idsecretaria = mov.idsecretariaorigem
        left join sis_secretaria secDestino on secDestino.idsecretaria = mov.idsecretariadestino
        left join sis_secretaria secSelecionada on secSelecionada.idsecretaria = sol.idsecretariaselecionada
        join lda_configuracao c
        where  
            sol.situacao not in('R','N')
            $filtro ";


$rs = execQueryPag($sql);

?>
<h1>Solicita&ccedil;&otilde;es Pendentes do Lei de Acesso</h1> 
<br><br>
<form action="index.php?lda_solicitacao" method="post" id="formulario">
<fieldset style="width: 50%;">
<legend>Buscar:</legend>
    <table align="center" width="200">
        <tr>
            <td nowrap>N&ordm; do Protocolo:</td>
            <td><input type="text" name="fltnumprotocolo" value="<?php echo $numprotocolo; ?>" maxlength="50" size="30" /></td>
        </tr>
        <tr>
            <td>Solicitante:</td>
            <td><input type="text" name="fltsolicitante" value="<?php echo $solicitante; ?>" maxlength="50" size="30" /></td>
        </tr>
        <tr>
			<td></td>
            <td>
                <br>
                <input type="submit" value="Buscar" class="botaoformulario"  name="acao" />
                <!--input type="submit" value="Imprimir" name="imprimir" /-->
            </td>
        </tr>
    </table>
</fieldset>		

<br>
<?php if (mysqli_num_rows($rs)>0){?>
<table class="tabLista">
    <tr>
        <th colspan="12" align="left">
            <span style="background-color: #FFB2B2;border:1px solid #000000;">&nbsp;&nbsp;&nbsp;</span> Prazo de resposta expirado
            <span style="background-color: #FFFACD;border:1px solid #000000;">&nbsp;&nbsp;&nbsp;</span> Prazo de resposta perto de expirar
        </th>
    </tr>
    <tr>
        <th></th>
        <th>Protocolo</th>
        <th>Tipo de Solicita&ccedil;&atilde;o</th>
       <th>Data Solicita&ccedil;&atilde;o</th> 
        <th>Solicitante</th>
        <th>Data Envio</th>
        <th>Origem</th>
        <th>Destino</th>
        <th>Prazo Restante</th>
         <th>Previs&atilde;o Resposta</th> 
        <th>Prorrogado?</th>
         <th>Situa&ccedil;&atilde;o</th> 
    </tr>
    <?php
    $cor = false;
    while ($registro = mysqli_fetch_array($rs)) {

            if($cor)
                $corLinha = "#dddddd";
            else
                $corLinha = "#ffffff";
            $cor = !$cor;
        
            //se tiver passado do prazo de resposta
            if ($registro['prazorestante'] < 0)
            {
                $corLinha = "#FFB2B2"; //vermelho - Urgente! Passou do prazo de resolu��o
            }
            //se faltar entre 1 e 5 dias para expirar o prazo de resposta
            elseif($registro['prazorestante'] >= 0 and $registro['prazorestante'] <= 5)
            {
                $corLinha = "#FFFACD"; //amarelo - Alerta! Est� perto de expirar
            }

            $confirmacao="";
            //se existir movimenta��o que n�o tenha sido recebida e o usuario for da secretaria de recebimento, ou a solicitita��o n�o tenha sido recebida nenhuma vez e o usu�rio tiver visibilidade de SIC central
            //solicita confirma��o de recebimento
            if((!empty($registro['idmovimentacao']) 
                and empty($registro['datarecebimento']) 
                and $registro['idsecretariadestino'] == $idSecretariaUsuario)
               or (empty($registro['datarecebimentosolicitacao']) 
                   and $visibilidadeSICcentral))
                $confirmacao = "if(!confirm('Confirma recebimento da solicita��o?'))return false; ";
            
                $clickMovimento = $confirmacao."editar('".$registro["idsolicitacao"]."&receber=sim&$parametrosIndex','movimentacao');";
            ?>
            <tr onMouseOver="this.style.backgroundColor = getCorSelecao(true);" onMouseOut="this.style.backgroundColor = '<?php echo $corLinha;?>';" style="background-color:<?php echo $corLinha;?>;cursor:pointer; cursor:hand; ">
                <td onClick="<?php echo $clickMovimento; ?>">
                    <?php
                        //se tiver movimenta��o
                        if (!empty($registro["idmovimentacao"]))
                            //seta que foi recebido se a data de recebimento tiver preenchida
                            $recebido = !empty($registro["datarecebimento"]);
                        else
                            //seta que foi recebido se a data de recebimento da solicita��o (primeiro recebimento) tiver preenchida
                            $recebido = !empty($registro["datarecebimentosolicitacao"]);
                    
                        if($recebido)
                        {
                            $imgTitulo = "Recebido";
                            $imagem = "mail_opened.png";
                        }
                        else
                        {
                            $imgTitulo = "N�o Recebido";
                            $imagem = "mail_closed.png";
                        }
                    ?>
                    <img width="24" align="middle" title="<?php echo $imgTitulo; ?>" height="24" src="../img/<?php echo $imagem; ?>">
                </td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo $registro["numprotocolo"]."/".$registro["anoprotocolo"]; ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo $registro["instancia"]; ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo bdToDate($registro["datasolicitacao"]); ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo $registro["solicitante"]; ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo bdToDate(!empty($registro["dataenvio"])?$registro["dataenvio"]:$registro["datasolicitacao"]); ?></td>                
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo strtoupper($registro["secretariaorigem"]); ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo strtoupper($registro["secretariadestino"]); ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo $registro["prazorestante"]; ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo bdToDate($registro["dataprevisaoresposta"]); ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo (!empty($registro["dataprorrogacao"]))?"Sim":"N�o"; ?></td>
                <td onClick="<?php echo $clickMovimento; ?>"><?php echo Solicitacao::getDescricaoSituacao($registro["situacao"]); ?></td>
            </tr>
            <?php 
    } ?>
    <tr>
        <td align="right" colspan="12">
            <?php include("../inc/paginacaoPorPostFim.php");?>
        </td>
    </tr>
    <?} else {?>
    <tr>
        <td align="right" colspan="12">
           N&atilde;o foram encontradas demandas pendentes 
        </td>
    </tr>
    <?}?>
</table><?php } ?> 
<br><br>
<input type="button" value="Voltar" name="voltar" class="botaoformulario" id="voltar" onclick="location.href='../inc/menu.php'" />
</form>
<?php
	include "../inc/rodape.php";
?>
