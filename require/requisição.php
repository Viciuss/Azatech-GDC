<?php
session_start();

if((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);
    header('location:./login/login.html');
}


?>


<!DOCTYPE html>
<html lang="pr-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar chromebook</title>
    <link rel="stylesheet" href="../login/login.css">
</head>
<body>
    <div class="geral">
        <form class="centro" action="validationReq.php" method="post">
            <h1>Alugar Chromebooks</h1>
            <div class="inputs">
                <input type="text" name="nomeP" placeholder=" " value="<?php echo $_SESSION['nome']?>" disabled>
                <label for="nomeP" class="label">Nome </label>    
            </div>
            <div class="inputs">
                <input type="text" name="quant" placeholder=" ">
                <label for="senha" class="label"> Digite sua a quantidade de chromebooks</label>
            </div>
            <div class="inputs">
                <input type="text" name="sala" id="" placeholder=" ">
                <label for="sala">Sala em que serão utilizados</label>
            </div>
            



            <button name="submit" value="submit" >Enviar pedido</button>
        </form>
    </div>
    
</form>
</body>
</html>