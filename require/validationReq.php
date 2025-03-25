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

            $sql = "INSERT INTO `registros`(`id`, `nomeProf`, `horaDevo`, `horaRet`, `quantidade`, `data`, `devolvidoStat`) VALUES ('','$nomeDoBuxa','$horaDevo','$hora','$quantidade','$data','0')";

            if ($conexao->query($sql) === TRUE) {
                echo "New record created successfully";
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