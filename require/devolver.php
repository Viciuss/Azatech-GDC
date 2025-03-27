<?php
    include_once("../login/config.php");
    session_start();


    $sql ="SELECT * FROM registros WHERE 1";
    $result = $conexao->query($sql);
    

?>


<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../login/login.css">
    <link rel="stylesheet" href="dev.css">
</head>
<body>
    
<div class="geral">
        <form class="centro" action="validationReq.php" method="post">
            <h1>Devolução</h1>
            <div class="pends" id="pends">
                <?php 
                while($devolvidos = mysqli_fetch_assoc($result)){
                    if($devolvidos["nomeProf"] == $_SESSION['nome'] && $devolvidos["devolvidoStat"] == 0){
                        echo "<div class='pendencia'>";
                        echo "<h4> No dia ". date("d-m",strtotime($devolvidos["data"])). " ficaram pendentes ". $devolvidos['quantidade']. " chromebooks" . "</h4>" . "<br>";
                        echo "<a href='./login/redef.html'> Em caso de erros relate aqui </a>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            



            <button name="submit" value="submit" id="aa" type="button">Marcar como devolvido</button>

            <button type="button" id="goBack">Voltar</button>
        </form>
    </div>
    
</form>
    
</body>
<script src="req.js"></script>
</html>