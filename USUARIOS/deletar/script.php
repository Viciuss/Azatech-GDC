<?php 

header('Content-Type: application/json');

if (!isset($_POST["confirm"]) || $_POST["confirm"] !== "true") {
    http_response_code(400);
    echo json_encode(["erro" => "Requisição inválida."]);
    exit;
}

include_once("../../LOGIN/validation/connect.php");

function atualizarTabela($conexao) {
    $queryAt = "SELECT * FROM LoginFunc";
    $result = $conexao->query($queryAt);
    $resultado = [];

    while ($dados = mysqli_fetch_assoc($result)) {
        $resultado[] = [
            $dados["IDFunc"],
            $dados["nomeFunc"],
            $dados["CPF"],
            $dados["hierarquia"]
        ];
    }

    return $resultado;
}


$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? null;
$cpf = $_POST['CPF'] ?? null;
$hierarquia = $_POST['hierarquia'] ?? null;

if (!$id || !$nome || !$cpf || !$hierarquia) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados incompletos."]);
    exit;
}


$stmt = $connect->prepare("DELETE FROM LoginFunc WHERE IDFunc=? AND nomeFunc=? AND CPF=? AND hierarquia=?");
$stmt->bind_param("isss", $id, $nome, $cpf, $hierarquia);
$stmt->execute();


if ($stmt->affected_rows > 0) {
    echo json_encode(atualizarTabela($connect));
} else {
    http_response_code(404);
    echo json_encode(["erro" => "Funcionário não encontrado ou já removido."]);
}
