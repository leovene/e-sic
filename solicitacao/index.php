<?php
 require_once("manutencao.php");
 require_once("../inc/topo.php");
?>

<h1>Formul�rio de Solicita��o de Informa��o</h1>
<br>
<?php 
if (empty($_GET['ok'])){
    ?>
    Descreva de forma detalhada sua solicita��o<br>
    <form action="<?php echo SITELNK ;?>solicitacao/index.php" id="formulario" method="post"  enctype="multipart/form-data">
    <?php include_once("../solicitacao/formulario.php");?>
    </form>
    <?php 
    getErro($erro);
}
else
{
    ?><br>Solita��o cadastrada com sucesso.<?php
}
include("../inc/rodape.php"); 
?>
