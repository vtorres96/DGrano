<?php

    session_start();

    $secao_usuario = $_SESSION['usuario'];
    $nivel_acesso = $_SESSION['nivel_acesso'];

    if(!isset($secao_usuario)){
        header("Location: menu.php");
    }

    require_once("config/conn.php");

    $query = $pdo->prepare("SELECT * FROM cadastro WHERE usuario = :secao_usuario");
    $query->execute([
        ":secao_usuario" => $secao_usuario
    ]);

    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if ($_GET && $_GET["id"]) {
        $query = $pdo->prepare('DELETE FROM pedido WHERE id = :id');
        
        $deletou = $query->execute([
            ":id" => $_GET["id"]
        ]);
    }

	if (isset($_POST['finalizar'])){
                   
        $id = $_REQUEST['id'];
        $codigo = array_filter($_REQUEST['codigo']);
        $descricao = $_REQUEST['descricao'];
        $preco = $_REQUEST['preco_venda'];	
        $quantidade = $_REQUEST['quantidade'];
        $custo_total = $_REQUEST['custo_total'];
        $status = $_REQUEST['status'];
        
        $query = $pdo->prepare("SELECT * FROM pedido WHERE cliente = :cliente"); 
        $query->execute([
            ":cliente" => $secao_usuario
        ]);
        $pedidos = $query->fetchAll(PDO::FETCH_ASSOC);
        
        for($i = 0; $i < count($codigo); $i++)  {
        
            if($pedidos > $i){
                $result = "UPDATE pedido set quantidade = '$quantidade[$i]', custo_total = '$custo_total[$i]', status = '$status[$i]' WHERE cliente = '$secao_usuario' AND id = '$id[$i]' ";
            } else {
                $result = "INSERT INTO pedido (cliente, data_venda, codigo, descricao, preco_venda, quantidade, custo_total, status) VALUES ('$secao_usuario', NOW(), '$codigo[$i]', '$descricao[$i]', '$preco[$i]', '$quantidade[$i]', '$custo_total[$i]', '$status[$i]')";
            }     
            $resultado = $pdo->query($result);             
        }
        header("Location: visualizar_pedidos.php");
	}
?>

<?php require_once("includes/head.php"); ?>

<body>

<?php 
    $active = "cliente";
    require_once("includes/navbar.php"); 
?>
<br><br>
<div class="container">		
    <h1>Finalize Seu Pedido</h1>	
    <br><br>     
    <div class="panel-body">
        <div class="table-responsive">
        <?php if (isset($deletou) && $deletou === true): ?>
            <div class="alert alert-success">
                O produto foi excluído do pedido
            </div>
        <?php endif; ?>
            <form method="POST" class="">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>                                            
                            <th>Cliente</th>
                            <th>Código Produto</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Custo Total Produto</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php	
                            $query = $pdo->prepare("SELECT * FROM pedido WHERE status = :status AND cliente = :cliente ORDER BY id");
                            $query->execute([
                                ":status" =>  " ",
                                ":cliente" => $secao_usuario
                            ]);

                            $produtos = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach($produtos as $produto): ?>	
                                <tr>
                                    <input type="hidden" name="id[]" value="<?= $produto['id'] ?>">
                                    <input type="hidden" name="codigo[]" value="<?= $produto['codigo'] ?>">
                                    <input type="hidden" name="descricao[]" value="<?= $produto['descricao'] ?>">
                                    <input type="hidden" id="preco_venda" name="preco_venda[]" value="<?= $produto['preco_venda'] ?>" special="price">
                                    <input type="hidden" name="status[]" value="FIN">
                                    
                                    <td><?= $produto['cliente'] ?></td>
                                    <td><?= $produto['codigo'] ?></td>
                                    <td><?= $produto['descricao'] ?></td>
                                    <td><?= $produto['preco_venda'] ?></td>
                                    <td><input type="text" id="quantidade" name="quantidade[]" value="1" autofocus special="quantity"></td>
                                    <td><input type="text" id="custo_total" name="custo_total[]" style="border:none;"></td>
                                    <td>
                                        <a href="finalizar_pedido.php?id=<?= $produto["id"] ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        ?>				
                    </tbody>
                </table>
                Valor Total R$: <span id="PrintSoma">0.00</span><br><br>
                <input type="submit" class="btn btn-primary" value="Finalizar Pedido" id="finalizar" name="finalizar">
            </form>
        </div>
        <br>		
    </div>
    <br><br><br><br>         
</div>

<?php require_once("includes/footer.php"); ?>

<script>
    /* Ínicio de Função criada para calcular dinamicamente o preço * quantidade e mostrar o resultado total por produto e por fim abaixo da tabela o total da compra */
    var prices = document.querySelectorAll("[id^=preco_venda]"),
        ammounts = document.querySelectorAll("[id^=quantidade]"),
        subTotals = document.querySelectorAll("[id^=custo_total]"),
        printSum = document.getElementById("PrintSoma")
    function sumIt() {
        var total = 0
        Array.prototype.forEach.call(prices, function (price, index) {
            var subTotal = (parseFloat(price.value) || 0) * (parseFloat(ammounts[index].value) || 0)
            subTotals[index].value = subTotal.toFixed(2)
            total += subTotal
        })
        printSum.textContent = total.toFixed(2)
    }
    Array.prototype.forEach.call(prices, function (input) {
        input.addEventListener("keyup", sumIt, false)
    })
    Array.prototype.forEach.call(ammounts, function (input) {
        input.addEventListener("keyup", sumIt, false)
    })
    /* Fim de Função criada para calcular dinamicamente o preço * quantidade e mostrar o resultado total por produto e por fim abaixo da tabela o total da compra */
    sumIt()
</script>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="ajax/valida_cadastro.js"></script>
<script type="text/javascript" src="ajax/valida_contato.js"></script>
<script type="text/javascript" src="js/jquery-scrolltofixed.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.isotope.js"></script>
<script type="text/javascript" src="js/wow.js"></script>
<script type="text/javascript" src="js/classie.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://malsup.github.io/min/jquery.form.min.js"></script>
<script type="text/javascript" src="js/animate.js"></script>

</body>
</html>
