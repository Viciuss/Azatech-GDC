<?php
if(isset($_POST["submit"]) && !empty($_POST['id'])){


    echo "<script>alert('Devolução realizada com sucesso!');</script>";
    echo $_POST['id'];

    include_once('../LOGIN/validation/connect.php');

    date_default_timezone_set("America/Sao_Paulo");

    $id = $_POST['id'];
    $dataDev = date("H:i:s");
    $sql = "UPDATE requisicoes SET statusDevo=1, horaDevolucao='$dataDev' WHERE IDPedido = ".$id;

    $result = $connect->query($sql);

        if ($connect->query($sql) === TRUE) {
            header("Location: ../INIT/gdc.php");
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
}else{
    echo "<script>alert('Selecione um pedido!');</script>";
    echo "<script>window.location.href = './devolucao.php';</script>";
}