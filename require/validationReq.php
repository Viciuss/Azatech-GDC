<?php
    session_start();
    if(isset($_POST["submit"]) && !empty($_POST["quant"])){
        include_once('../login/config.php');
            date_default_timezone_set("America/Sao_Paulo");

            $nomeDoBuxa = $_SESSION['nome'];
            $quantidade = test_input($_POST['quant']);
            $data = date("Y-m-d");
            $hora = date("H:i:s");
            $horaDevo = 0;

            $sql = "INSERT INTO `registros`(`data`, `nomeProf`, `quantidade`, `horaRet`, `horaDevo`, `devolvidoStat`)VALUES ('$data','$nomeDoBuxa','$quantidade','$hora','$horaDevo','0')";

            if ($conexao->query($sql) === TRUE) {
                header("Location: ../index.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conexao->error;
            }
            

        }
    
    function test_input($test){
        $test = trim($test);
        $test = stripslashes($test);
        $test = htmlspecialchars($test);
        return $test;
    }