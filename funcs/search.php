 <?php 
     
     session_start();

     $secao_usuario = $_SESSION['usuario'];
     $nivel_acesso = $_SESSION['nivel_acesso'];
 
     if(!isset($secao_usuario)){
         header("Location: menu.php");
     }
 
     require_once("../config/conn.php");

     if(isset($_POST["retorno"])){
 
          $query = $pdo->query("SELECT * FROM produtos WHERE descricao LIKE '%".$_POST["retorno"]."%'");  
          $produto = $query->fetch(PDO::FETCH_ASSOC);

          $output = '<ul class="list-group" id="xy">'; ?>
               <li class="list-group-item">
                    <img style="width:15%;" src="../imagem.php?id=<?= $produto["id"] ?>"><br>
                    <?= $produto["descricao"]?><br>
                    <strong>R$ </strong><?= number_format($produto["preco"],2) ?></strong><br>
               </li>
          <?php $output .= '</ul>';  
          echo $output;  
     } 
 
 ?>