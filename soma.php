<?php                            

   $servername = "192.168.1.110";
   $username = "root";
   $password = "1521128";
   $dbname = "teste123"; 
   
  /* $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "tcc"; */
	
    $soma = mysqli_connect($servername, $username, $password, $dbname) or die ("Erro");
    $db = mysqli_query($soma,'SELECT SUM(custo_total) FROM pedido WHERE status = " " ');
    $result = mysqli_fetch_array($db);
    echo "Valor total : R$ " . number_format($result[0],2) . "";
    
?>
