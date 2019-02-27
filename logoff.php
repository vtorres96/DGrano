<?php
	unset($_SESSION['usuario']);
  unset($_SESSION['senha']);
	unset($_SESSION['nivel_acesso']);

	session_destroy();
	
	header("Location: menu.php");
?>
