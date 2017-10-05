<?php
error_reporting(E_ERROR);

define("SISTEMA_NOME", "e-SIC Livre"); //nome do sistema para exebição em lugares diversos
define("SISTEMA_CODIGO", "esiclivre"); //codigo para definição da lista de sessão do sistema

// Configurações de banco de dados
define("DBHOST", "localhost");
define("DBUSER", "usuariodobanco");
define("DBPASS", "senhadousuariodobanco");
define("DBNAME", "nomedobanco");

// definições de e-mail
define("USE_PHPMAILER", false);
define("MAIL_HOST", "mail.gov.br");
define("SMTP_AUTH", false);
define("SMTP_USER", "");
define("SMTP_PWD", "");

// Endereços do site
define("SITELNK", "http://www.seusite/esiclivre/");	//Endereço principal do site
define("URL_BASE_SISTEMA", "http://www.seusite/esiclivre/");	//Endereço principal do site

?>
