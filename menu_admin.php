<?php

    session_start();

    $secao_usuario = $_SESSION['usuario'];
    $nivel_acesso = $_SESSION['nivel_acesso'];

    if(!isset($secao_usuario) || $nivel_acesso != 1){
      header("Location: menu.php");
    }

    require_once("config/conn.php");

    $query = $pdo->prepare("SELECT * FROM cadastro WHERE usuario = :secao_usuario");
    $query->execute([
        ":secao_usuario" => $secao_usuario
    ]);

    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['alterar'])){

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $query = $pdo->prepare("UPDATE cadastro SET nome = :nome , email = :email, senha = :senha WHERE usuario = :usuario");
        $alterou = $query->execute([
            ":usuario" => $secao_usuario,
            ":nome" => $nome,
            ":email" => $email,
            ":senha" => $senha
        ]);        
    }

    $query = $pdo->query("SELECT status, SUM(custo_total) AS valores FROM pedido GROUP BY status");
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once("includes/head.php"); ?>

<body>

<?php 
    $active = "admin";
    require_once("includes/navbar.php"); 
?>

<div class="container">
    <section class="main-section alabaster" id="Software">
        <h2>Área administrativa</h2>
        <br><br>

            <?php if(isset($alterou) && $alterou === true): ?>
                    <div class="alert alert-success">
                        Usuário alterado com sucesso
                    </div>
            <?php endif; ?>

            <p>A D'Grano® Panificadora tem o compromisso de fornecer meios para que seus clientes possam ter uma gestão sistêmica e eficiente dos números de sua empresa.</p>
            
            <div class="row">
                <div class="col-lg-7 col-sm-8 featured-work">
                <div style="width:900px; background:rgba(251, 251, 251, 0.9);">
                    <div id="piechart" style="width: 900px; height: 500px;"></div>
                </div>
                </div>
            </div>
    </section>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Alteração de Cadastro</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label class="control-label">Nome:</label>
                        <input name="nome" type="text" class="form-control" value="<?= $usuario["nome"]; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Email:</label>
                        <input name="email" type="text" class="form-control" value="<?= $usuario["email"] ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Senha:</label>
                        <input name="senha" type="text" class="form-control" value="<?= $usuario["senha"] ?>">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" value="Alterar" name="alterar">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart(){
        var data = google.visualization.arrayToDataTable([
        ['Status', 'Valores'],
        <?php foreach($rows as $row): ?>
            ['<?= $row["status"] ?>', <?= number_format($row["valores"],2)?>],    
        <?php endforeach; ?>
        ]);
        var options = {
            title: 'Gráfico de Vendas - Pedidos Finalizados e em Aberto',
            is3D:true,
            pieHole: 0.4
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
