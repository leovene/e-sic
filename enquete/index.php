<?php
 include("manutencao.php");
?>
<html>
<head>
        <title>Lei de Acesso - Enquete</title>
        <!-- CSS -->
        <meta name="verify-v1" content="miqBcW00PywY1Jm7/yQP8ztDacIWFV9gQRTCmHuai9w=" />
        <!-- TAG PARA O GOOGLEBOT -->
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <link rel="stylesheet" type="text/css" href="../css/estilo.css">

        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script src="../js/functions.js"></script>

</head>
<body>


<div id="conteudo" style="width: 800;">
<h2>Avalie nosso sistema!</h2>    
<br>

<?php
if($_POST['Enviar'] and empty($erro))
{
    echo "Sua avaliação foi cadastrada com sucesso!<br><br>Obrigado por sua colaboração!";
}
else
{
    ?>
    <form method="post" action="index.php">
        <input type="radio" name="resposta" value="U" <?php echo ($resposta=="U")?"checked":"";?>>Ruim &nbsp;
        <input type="radio" name="resposta" value="R" <?php echo ($resposta=="R")?"checked":"";?>>Regular &nbsp;
        <input type="radio" name="resposta" value="B" <?php echo ($resposta=="B")?"checked":"";?>>Bom &nbsp;
        <input type="radio" name="resposta" value="O" <?php echo ($resposta=="O")?"checked":"";?>>&Oacute;timo &nbsp;

        <br><br>Considera&ccedil;&otilde;es:<br>
        <textarea name="comentario" onKeyUp="setMaxLength(2000,this);" rows="8" cols="70" ><?php echo $comentario;?></textarea>

        <br><br>
        <input type="submit" value="Enviar" name="Enviar" class="botaoformulario" />
    </form>
    <?php 
    getErro($erro);
}
?>
</div>
</body>
</html>
