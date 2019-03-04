 <?php 
     
     session_start();

     $secao_usuario = $_SESSION['usuario'];
     $nivel_acesso = $_SESSION['nivel_acesso'];
 
     if(!isset($secao_usuario)){
         header("Location: menu.php");
     }
 
     require_once("../config/conn.php");

     if(isset($_POST["retorno"])){
         
          $output = '';  
          $query = $pdo->query("SELECT * FROM produtos WHERE descricao LIKE '%".$_POST["retorno"]."%'");  
          $produto = $query->fetch(PDO::FETCH_ASSOC);

          $output = '<ul class="list-unstyled" id="xy">';   
          foreach($produto as $prod)  {  
               $output .= '<img style="width:75%;" src="../imagem.php?id=<?= $prod["id"] ?>">';
               $output .= '<div class="caption">';
                    $output .= '<strong>Descrição:</strong> <?= $prod["descricao"] ?><br>';
                    $output .= '<strong>Preço: </strong>  R$ <strong style="font-size:25px;"><?= number_format($prod["preco"],2) ?></strong><br><br>';
                    $output .= '<input type="submit" class="btn btn-primary" id="salvar" value="Adicionar ao Pedido" data-loading-text="Adicionando...">';
               $output .= '</div>';
          }  
          $output .= '</ul>';  
          echo $output;  
     } 
 
 ?>