<?php
session_start();
if((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);
    header('location:./login/login.html');
}else{
    include_once('../config.php');

    $nCPF = test_input($_POST["cpf"]);
    $nNome = test_input($_POST["nome"]);
    $nSenha = test_input($_POST["senha"]);
    $nHierarquia = $_POST["cargos"];


    // Verifica se o CPF já está cadastrado
    $sqlCheck = "SELECT * FROM `login` WHERE cpf = '$nCPF'";

    $resultCheck = $conexao->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        echo "CPF já cadastrado.";
    } else {
        $senhaHash = password_hash($nSenha, PASSWORD_DEFAULT); // Hash da senha


        $sql = "INSERT gdc.login (nome,cpf,senha,hierarquia) VALUES ('$nNome','$nCPF','$senhaHash','$nHierarquia')";

        if ($conexao->query($sql) === TRUE) {
            header("Location: ../../index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conexao->error;
        }
    }



}
        function test_input($test){
            $test = trim($test);
            $test = stripslashes($test);
            $test = htmlspecialchars($test);
            return $test;
        }

?>