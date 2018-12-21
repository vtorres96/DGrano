 <?php 
 
    include('conexao.php');

     /* INICIO SUGESTÃO DE PRODUTOS PARA ORIENTAR USUARIO */
     if(isset($_POST["retorno"])){
         
            $outputy = '';  
            $query = "SELECT * FROM produtos WHERE descricao LIKE '%".$_POST["retorno"]."%'";  
            $resulta = mysqli_query($conn, $query);  
            $outputy = '<ul class="list-unstyled" id="xy">'; 
          
            if(mysqli_num_rows($resulta) > 0)  {  
                 while($row = mysqli_fetch_array($resulta))  {  
                      $outputy .= '<li>'.$row["descricao"].'</li>';  
                 }  
            }  
            else  {  
                  return json_encode(array( 'error' => mysqli_error($conn) )); 
            } 
            
            $outputy .= '</ul>';  
            echo $outputy;  
     }  
     /* FIM SUGESTÃO DE PRODUTOS PARA ORIENTAR USUARIO */
 
 ?>

<div id="mensagem"></div>

<input type="hidden" name="cliente" value="<?php echo $secao_usuario; ?>">
<div class="col-lg-4">

    <img style="width:75%;" src="imagem.php?id=<?php echo $row['id']; ?>" />

    <div class="caption">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <br>
            <input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>"> <br>
            <strong>Descrição:</strong> <?php echo $row['descricao']; ?> <input type="hidden" name="descricao" value="<?php echo $row['descricao']; ?>">  <br>
            <strong>Preço: </strong>  R$: <?php echo number_format($row['preco'],2) ?> <input type="hidden" name="preco" value="<?php echo $row['preco']; ?>"> <br><br>
            <input type="hidden" name="status" value="">
            <input type="submit" class="btn btn-primary" id="salvar" value="Adicionar ao Pedido" data-loading-text="Adicionando..." >
    </div>
    <br><br><br><br><br>
</div>