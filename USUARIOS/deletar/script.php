<?php 


$confirm = $_POST["confirm"];
function atualizarTabela($conexao){
    $queryAt = "SELECT * FROM LoginFunc";
    $result = $conexao->query($queryAt);
    $resultado = [];


    while($dados = mysqli_fetch_assoc($result)){
        array_push($resultado, array($dados["IDFunc"],$dados["nomeFunc"], $dados["CPF"],$dados["hierarquia"]));
        return $resultado;
    };
}


if($confirm != true){
    return throw new Exeption("Nao sei oq vc tentou fazer, mas fez errado");
}else{

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['CPF'];
        $hierarquia = $_POST['hierarquia'];

        include_once("../../LOGIN/validation/connect.php");

        $query = "SELECT * FROM LoginFunc WHERE IDFunc=$id AND nomeFunc='$nome' AND CPF=$cpf AND hierarquia='$hierarquia'";

        if ($connect->query($query)){

            print_r(atualizarTabela($connect));
        


        } else {
            echo "Error: " . $query . "<br>" . $connect->error;
        };



};






