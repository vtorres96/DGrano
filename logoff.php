<?php
	session_start();

	unset($_SESSION['usuario']);
  unset($_SESSION['senha']);
	unset($_SESSION['nivel_acesso']);

  session_destroy();
  //redirecionar o usuario para a página de login
	header("Location: menu.php");
?>
