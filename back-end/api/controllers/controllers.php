<?php
include_once('../config.php');
include_once('../entities/entities.php');

class Functions {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function test_input($test){
        $test = trim($test);
        $test = stripslashes($test);
        $test = htmlspecialchars($test);
        return $test;
    }

    public function createUser($cpf, $nome, $senha){
        $cpf = $this->test_input($cpf);
        $nome = $this->test_input($nome);
        $senha = $this->test_input($senha);
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql_search = "SELECT * FROM `login` WHERE cpf = '$cpf'";
        $result = $this->conexao->query($sql_search);

        if($result && $result->num_rows > 0){
            return ["error" => "Esse CPF já está cadastrado!"];
        }

        $professor = newProf($nome, $cpf, $senha_hash); // função em entities.php
        $sql_insert = "INSERT INTO `login` (cpf, nome, senha) VALUES ('$professor->cpf', '$professor->name', '$professor->password')";
        $result = $this->conexao->query($sql_insert);

        if($result){
            return ["success" => true];
        } else {
            return ["error" => $this->conexao->error];
        }
    }

    public function test(){
        return ["success" => true];
    }

    public function getUser($cpf, $senha){
        $cpf = $this->test_input($cpf);
        $senha = $this->test_input($senha);

        $sql_search = "SELECT * FROM `login` WHERE cpf = '$cpf'";
        $result = $this->conexao->query($sql_search);

        if($result && $result->num_rows > 0){
            $dados = $result->fetch_assoc();
            if (password_verify($senha, $dados['senha'])) {
                session_start();
                $_SESSION["cpf"] = $dados["cpf"];
                $_SESSION["nome"] = $dados["nome"];
                header("Location: ../../front-end/index.php");
                exit;
            } else {
                return ["error" => "Senha incorreta"];
            }
        } else {
            return ["error" => "Usuário não encontrado"];
        }
    }
}
