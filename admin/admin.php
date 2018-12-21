<?php session_start();  ?>

<?php

    if(!isset($_SESSION['usuario']) && (!isset($_SESSION['senha']))){
        header("Location: ../login.php");
    }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>admin</title>
<style>
*{margin:0; padding:0;}
#topo{width:100%; height:60px; position:relative; margin:0 auto; background-color:#333; overflow:hidden;}
#topo h1{font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif; font-size:36px; color:#fff; line-height:60px;}
</style>
</head>
<body>
<?php
$secao_usuario = $_SESSION['usuario'];

?>
<div id="topo">
<h1>Ola :<?php  echo $secao_usuario;   ?></h1>
</div>
<a href="?sair">sair</a>
<?php
if(isset($_REQUEST['sair'])){
	session_destroy();
	header("Location: ../login.php");
	}
?>
</body>
</html>
