<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
	<head>
                <title> SIC: Sistema de Informação ao Cidadão </title>
		 
		<!-- CSS -->
		<meta name="verify-v1" content="miqBcW00PywY1Jm7/yQP8ztDacIWFV9gQRTCmHuai9w=" />
		<!-- TAG PARA O GOOGLEBOT -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">
               <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

               <link href="css/bootstrap.min.css" rel="stylesheet">
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
          <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
          <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
	

		<meta name="E-Sic Livre" content="Portal da Prefeitura Municipal do Natal - SEMPLA - Secretaria de Planejamento, Orçamento e Finanças" />
		<meta http-equiv="pragma" content="no-cache" />
                <meta name="revisit-after" content="1" />
		<meta name="classification" content="Internet" />	
		<meta name="description" content="Portal da Prefeitura Municipal do Natal - SEMPLA - Secretaria de Planejamento, Orçamento e Finanças" />
		<meta name="keywords" content="Prefeitura do Natal, natal, rn, sempla, natal, rn, noticias, serviços" />
		<meta name="robots" content="ALL" />
		<meta name="distribution" content="Global" />
		<meta name="rating" content="General" />
		<meta name="author" content="SEMPLA, Prefeitura do Natal" />
		<meta name="language" content="pt-br" />
		<meta name="doc-class" content="Completed" />
		<meta name="doc-rights" content="Public" />
		<meta http-equiv="X-UA-Compatible" content="IE=8">
		
		<link rel="stylesheet" type="text/css" href="../css/estilo.css">

              	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
                <script src="../js/functions.js"></script>
	
	</head>
	<body> 
        <div id="principal">
        <header class="page-header">
		<div id="out">
			<div id="conteudo">
				<div id="cabecalho">
					<div id="menu">
						<ul>
                                                    <?php if (!empty($_SESSION[SISTEMA_CODIGO])) { ?>
                                                            <ul>

                                                                    <li class="opcao"><a href="../index.php">In&iacute;cio</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre" />
                                                                    <li class="opcao"><a href="../solicitante">Alterar Cadastro</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre"/>
                                                                    <li class="opcao"><a href="../alterasenha">Alterar Senha</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre"/>
                                                                    <li class="opcao"><a href="../solicitacao">Fazer Solicita&ccedil;&atilde;o</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre"/>
                                                                    <li class="opcao"><a href="../acompanhamento">Solicita&ccedil;&otilde;es Realizadas</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre"/>
                                                                    <li class="opcao"><a href="../index/logout.php">Sair</a></li>
                                                            </ul>
                                                    <?php } else {?>
                                                            <ul>
                                                                    <li class="opcao"><a href="#"></a></li>
                                                                    <li class="opcao"><a href="../index">Lei de Acesso &agrave; Informa&ccedil;&atilde;o</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre"/>
                                                                    <li class="opcao"><a href="../manual/InformacaoMundo.php">Acesso &agrave; Informa&ccedil;&atilde;o no Mundo</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre"/>
                                                                    <li class="opcao"><a href="../manual/LeiAcessoMundo.php">SIC'S</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre"/>
                                                                    <li class="opcao"><a href="../manual">Manual</a></li>
                                                                    <img src="../css/img/pipe.png" alt="Imagem E-sic Livre"/>
                                                                    <li class="opcao"><a href="../estatistica">Estat&iacute;stica</a></li>
                                                            </ul>
                                                    <?php }?>
						</ul>
					</div>
					</div>
					
					<div id="corpo">
        </header>

