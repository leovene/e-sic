<?php
error_reporting(E_ERROR);

define("SISTEMA_NOME", "e-SIC Livre"); //nome do sistema para exibi��o em lugares diversos
define("SISTEMA_CODIGO", "esiclivre"); //codigo para defini��o da lista de sess�o do sistema

// Configura��es de banco de dados
define("DBHOST", "localhost");
define("DBUSER", "usuariodobanco");
define("DBPASS", "senhadousuariodobanco");
define("DBNAME", "nomedobanco");

// Defini��es de e-mail
define("USE_PHPMAILER", false);
define("MAIL_HOST", "mail.gov.br");
define("SMTP_AUTH", false);
define("SMTP_USER", "");
define("SMTP_PWD", "");

// Endere�os do site
define("SITELNK", "http://www.seusite/esiclivre/");	//endere�o principal do site
define("URL_BASE_SISTEMA", "http://www.seusite/esiclivre/");	//endere�o principal do site

?>
