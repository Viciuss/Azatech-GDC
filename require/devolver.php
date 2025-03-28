<?php
    include_once("../login/config.php");
    session_start();

    $sql = "SELECT * FROM registros WHERE devolvidoStat = 0";
    $result = $conexao->query($sql);
    
    if((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['cpf']);
        unset($_SESSION['senha']);
        header('location: ../login/login.html');
    }
?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolução de Chromebooks</title>
    <link rel="stylesheet" href="dev.css">
    <link rel="stylesheet" href="modal.css">
</head>
<body>
<div class="container">
<form class="centro" action="./validationDev.php" method="post">

        <div class="modal-container">
            <div class="modal">
                <div class="fundo-texto">
                    <h2>Info</h2>

                    <span>
                        <p>Você tem certeza que deseja marcar como devolvido?</p>
                        <p>Essa ação não pode ser desfeita.</p>
                        <p>Após clicar em OK, o pedido será marcado como devolvido e não poderá ser alterado.</p>
                    </span>

                    <div class="btns">
                        <button class="btnOK" type="submit" name="submit">OK</button>
                        <button class="btnClose" type="button" onclick="closeModal()">Close</button>
                    </div>
                </div>
        </div>
    </div>
    

        <h1>Devolução</h1>
        <div class="carrossel-container">
            <div class="carrossel-inner" id="carrossel">
                <?php
                $first = true;
                while($devolvidos = mysqli_fetch_assoc($result)) {
                    if($devolvidos["nomeProf"] == $_SESSION['nome']) {
                        $activeClass = $first ? 'active' : '';
                        echo "<div style='color:black;'class='carrossel-item $activeClass'>";
                        echo "<h4>No dia ". date("d-m",strtotime($devolvidos["data"])). " ficaram pendentes ". $devolvidos['quantidade']. " chromebooks</h4>";
                        echo "<h4>ID do pedido: ". $devolvidos['id']. "</h4>";
                        echo "<label><input type='radio' class='check' name='id' value=".$devolvidos["id"].">Selecionar</label><br>";
                        echo "<a href='./login/redef.html' class='text-info'>Em caso de erros relate aqui</a>";
                        echo "</div>"; 
                        $first = false;
                    }
                }
                ?>
            </div>
            <button type="button" class="carousel-control-prev" id="prevBtn">&#10094;</button>
            <button type="button" class="carousel-control-next" id="nextBtn">&#10095;</button>
        </div>

        <div class="mt-3">
            <button type="button" onclick="openModal()" id="env" class="btn">Marcar como devolvido</button>
            <button type="button" id="goBack" class="btn btn-danger">Voltar</button>
        </div>
    </form>
</div>

    <script src="req.js"></script>
</body>
</html>
