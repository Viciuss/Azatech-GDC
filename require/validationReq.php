<?php
    session_start();
    if(isset($_POST["submit"]) && !empty($_POST["quant"])){
        include_once('../LOGIN/validation/connect.php');
            date_default_timezone_set("America/Sao_Paulo");

            $quantidade = test_input($_POST['quant']);
            $data = date("Y-m-d");
            $hora = date("H:i:s");


            $sql = "INSERT INTO requisicoes(dataPedido, horaPedido, horaDevolucao, statusDevo,IDFunc, quantidade)VALUES ('$data', '$hora', '00:00:00', 0, '".$_SESSION['id']."', '$quantidade')";

            if ($connect->query($sql) === TRUE) {
                header("Location: ../INIT/gdc.php");
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