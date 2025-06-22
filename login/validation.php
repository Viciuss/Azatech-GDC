<?php
    session_start();
    if(isset($_POST["submit"]) && !empty($_POST["cpf"]) && !empty($_POST["cpf"])){
        include_once('config.php');
        
        
        $cpf =test_input($_POST["cpf"]);
        
        
        $senha =test_input($_POST["senha"]);
        
        
        $sql = "SELECT * FROM `login` WHERE cpf = $cpf and senha = '$senha'";
        $result = $conexao ->query($sql);
        
        $dadosProf = mysqli_fetch_assoc($result);
        
        $nome = $dadosProf['nome'];


        
        if(mysqli_num_rows($result)<= 0){
                unset($_SESSION['cpf']);
                unset($_SESSION['senha']);
                header("location:./login.html");
                $_SESSION['msg'] = "<p style='color: red;'>Erro: CPF ou senha incorretos</p>";
                echo "nao foi";
            }else{
                $_SESSION['hierarquia'] = $dadosProf['hierarquia'];
                $_SESSION['nome'] = $nome;
                $_SESSION['cpf'] = $cpf;
                $_SESSION['senha'] = $senha;
                header("location:../index.php");
                echo "foi";
            }

    }else{
    header("location:login.html");
    }
    
    function test_input($test){
        $test = trim($test);
        $test = stripslashes($test);
        $test = htmlspecialchars($test);
        return $test;
    }

?>