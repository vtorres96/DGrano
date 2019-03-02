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

    if(isset($_POST['deletar'])){

        $id = $_POST['id_prod'];

        $query = $pdo->prepare("DELETE FROM pedido WHERE id = :id");
        $deletou = $query->execute([
            ":id" => $id
        ]);        
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
                    <form method="POST" action="salvar_finalizar_pedido.php" class="">
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
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_prod" value="<?= $produto['id'] ?>">
                                        <td><input type="submit" name="deletar" class="myButton" value="" title="Excluir"></td>
                                    </form>
                                </tr>
                        <?php
                            endforeach;
                        ?>				
                    </form>
                </tbody>
            </table>
            Valor Total R$: <span id="PrintSoma">0.00</span>
        </div>
        <br>		
        <input type="submit" class="btn btn-primary" value="Finalizar Pedido" id="finalizar" name="finalizar">
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
