<?php
error_reporting(E_ERROR);

define("SISTEMA_NOME", "e-SIC Livre"); //nome do sistema para exibição em lugares diversos
define("SISTEMA_CODIGO", "esiclivre"); //codigo para definição da lista de sessão do sistema

define("DBHOST", "localhost");
define("DBUSER", "usuariodobanco");
define("DBPASS", "senhadousuariodobanco");
define("DBNAME", "nomedobanco");

define("USE_PHPMAILER", false);
define("MAIL_HOST", "mail.gov.br");
define("SMTP_AUTH", false);
define("SMTP_USER", "");
define("SMTP_PWD", "");

define("SITELNK", "http://www.seusite/esiclivre/");

define("URL_BASE_SISTEMA", "http://www.seusite/esiclivre/restrito/");

// Caminho para arquivos das classes do projeto Lei de Acesso
define("DIR_CLASSES_LEIACESSO","../class/");

define("SIS_TOKEN", date("H") . (date("d")+1) . "");
?>