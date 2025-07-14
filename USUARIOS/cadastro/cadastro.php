<?php
session_start();
if((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);
    header('location../../LOGIN/login.html');
}else{
    include_once('../../LOGIN/validation/connect.php');

    $nCPF = test_input($_POST["cpf"]);
    $nNome = test_input($_POST["nome"]);
    $nSenha = test_input($_POST["senha"]);
    $nHierarquia = $_POST["cargos"];


    // Verifica se o CPF já está cadastrado
    $sqlCheck = "SELECT * FROM LoginFunc WHERE CPF = $nCPF";

    $resultCheck = $connect->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        echo "CPF já cadastrado.";
    } else {
        $senhaHash = hash('sha256',$nSenha); // Hash da senha


        $sql = "INSERT LoginFunc (nomeFunc,CPF,senha,hierarquia) VALUES ('$nNome',$nCPF,'$senhaHash','$nHierarquia')";

        if ($connect->query($sql) === TRUE) {
            header("Location: ../GerenciarUsuarios.php");
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
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