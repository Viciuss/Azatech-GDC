<?php
if(isset($_POST["submit"]) && !empty($_POST['id'])){


    echo "<script>alert('Devolução realizada com sucesso!');</script>";
    echo $_POST['id'];

    include_once('../login/config.php');

    date_default_timezone_set("America/Sao_Paulo");

    $id = $_POST['id'];
    $dataDev = date("H:i:s");
    $sql = "UPDATE `registros` SET `devolvidoStat`=1, `horaDevo`='$dataDev' WHERE id = ".$id;

    $result = $conexao->query($sql);

        if ($conexao->query($sql) === TRUE) {
            header("Location: ../index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conexao->error;
        }
}else{
    echo "<script>alert('Selecione um pedido!');</script>";
    echo "<script>window.location.href = './devolver.php';</script>";
}