<?php
include_once("./login/config.php");
session_start();


if((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);
    header('location:./login/login.html');
}

$sql ="SELECT * FROM registros WHERE 1";
$result = $conexao->query($sql);





#$data = date("d-m",strtotime($dadosLinha["data"]));

#print_r($data);

?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="geral">
        <div class="registro">
            <div class="a">
                <select name="selector" id="selectDia">
                <?php
                        while($diaD = $result->fetch_assoc()){
                            echo "<option value='". date("d-m",strtotime($diaD['data'])). "'>".
                            date("d-m",strtotime($diaD['data']))."</option>";
                        }
                        $result->data_seek(0);
                    ?>
                </select>
                <button id="regPesq">Pesq</button>
            </div>
            <div class="regAlug" id="alug">
                <table class="alug" style="width: 100%; align-items: center; text-align: center;">
                    <thead >
                        <tr>
                            <th>Devolvido?</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody id="tabela" style="width: 100%; align-items: center; text-align: center;">
                            <tr>
                                <td>Não</td>
                                <td>Placeholder Brabo</td>
                                <td>20</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="centro">
            <div class="barraPesq">
                <input type="text" name="pesquisa" id="pesquisae" placeholder="Pesquisar professor">
                <button id="pesquis">Pesquisar</button>
            </div>
            <div id="histDia">
                <select name="histDia" id="">
                    <?php
                        while($diaD = $result->fetch_assoc()){
                            echo "<option value='". date("d-m",strtotime($diaD['data'])). "'>".
                            date("d-m",strtotime($diaD['data']))."</option>";
                        }
                        $result->data_seek(0);
                    ?>
                    </select>
                <button id="update">Pesq</button>
            </div>
            <div class="historico">
                <table>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Hora de retirada</th>
                            <th>Devolução</th>
                            <th>Professor</th>
                            <th>Carrinho/Quantidade</th>
                        </tr>
                    </thead>
                    <tbody id="histTable">
                        <?php
                            while($dadosLinha = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                    echo "<td>". date("d-m",strtotime($dadosLinha["data"])) ."</td>";
                                    echo "<td>". $dadosLinha['horaRet'] ."</td>";
                                    echo "<td>".$dadosLinha['horaDevo']."</td>";
                                    echo "<td>".$dadosLinha['nomeProf']."</td>";
                                    echo "<td>".$dadosLinha['quantidade']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="erp">
            <div class="dados">
                <div>
                    <img class="foto" src="imgs/imgPlaceholder.png" alt="fotoProfessor">
                </div>
                <div class="info">
                    <h2 class="profName"><?php echo $_SESSION['nome']?></h2>
                    <h2 class="registroProf"><?php echo $_SESSION['cpf']?></h2>
                </div>
            </div>
            <div class="functions">
                <button >Relatar problema em chromebook</button>
                <button id="require">Alugar chromebooks</button>
            </div>
        </div>
    </div>
    <img src="require/requisição.html" alt="">
</body>
</html>
