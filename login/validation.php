<?php
session_start();

if (isset($_POST["submit"]) && !empty($_POST["cpf"]) && !empty($_POST["senha"])) {
    include_once('config.php');

    $cpf = test_input($_POST["cpf"]);
    $senha = test_input($_POST["senha"]);

    $sql = "SELECT * FROM login WHERE cpf = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $dadosProf = $result->fetch_assoc();
        if (password_verify($senha, $dadosProf['senha'])) {
            $_SESSION['hierarquia'] = $dadosProf['hierarquia'];
            $_SESSION['nome'] = $dadosProf['nome'];
            $_SESSION['cpf'] = $dadosProf['cpf'];
            header("Location: ../index.php");
            exit;
        }
    }

    $_SESSION['msg'] = "<p style='color: red;'>Erro: CPF ou senha incorretos</p>";
    header("Location: ./login.html");
    exit;
} else {
    header("Location: login.html");
    exit;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
