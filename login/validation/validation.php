<?php

if(!isset($_POST['CPF']) || !isset($_POST['password']) || !isset($_POST['submit'])) {
    header("Location: ../login.html");
    exit();
}

function testCPF($cpf) {

    $cpf = preg_replace('/\D/', '', $cpf);
    

    if (strlen($cpf) != 11) {
        return false;
    }


    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

/*
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
*/
    return true;
}

function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if(testCPF($_POST['CPF']) == false){
    header("Location: login.html?error=invalidCPF");
    exit();
} else {
    require_once 'connect.php';

    $cpf = testInput($_POST['CPF']);
    $password = testInput($_POST['password']);
    
    if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
    }

    # Prepare the SQL query to prevent SQL injection
    $cpf = mysqli_real_escape_string($connect, $cpf);
    $password = mysqli_real_escape_string($connect, $password);
    # Hash the password
    $password = hash('sha256', $password);





    $query = "SELECT * FROM LoginFunc WHERE CPF = '$cpf' AND senha = '$password'";

    if($result = mysqli_query($connect, $query)) {
        if (mysqli_num_rows($result) > 0) {
            session_start();
            
            $dados = mysqli_fetch_assoc($result);
            
            $_SESSION['id'] = $dados['IDFunc'];
            $_SESSION['cpf'] = $cpf;
            $_SESSION['nome'] = $dados['nomeFunc'];
            $_SESSION['funcao'] = $dados['hierarquia'];


            header("Location: ../../INIT/gdc.php");
            exit();
        } else {
            header("Location: login.html?error=invalidCredentials");
            exit();
        }
    } else {
        header("Location: login.html?error=queryError");
        exit();
    }




}