<?php
include "../inc/security.php";

if ($_SESSION[SISTEMA_CODIGO]) {
	$_SESSION = array();
	session_destroy();
}
Redirect("../index.php");

