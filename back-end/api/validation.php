<?php
    if(isset($_POST["submit"]) && !empty($_POST["cpf"]) && !empty($_POST["cpf"])){
        include_once('config.php');
        session_start();
        

        $cpf   = test_input($_POST["cpf"]);        
        $senha = test_input($_POST["senha"]);
        $nome  = test_input($_POST["nome"]);

        
    }else{
    header("location:./login/login.html");
    }
    
    function test_input($test){
        $test = trim($test);
        $test = stripslashes($test);
        $test = htmlspecialchars($test);
        return $test;
    }

?>