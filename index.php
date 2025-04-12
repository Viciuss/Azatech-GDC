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

$pendencia = false;

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
                            <th>id</th>
                            <th>Data</th>
                            <th>Hora de retirada</th>
                            <th>Devolvido?</th>
                            <th>Hora da Devolução</th>
                            <th>Professor</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody id="histTable">
                        <?php
                            while($dadosLinha = mysqli_fetch_assoc($result)){
                                $devolvidoStat = $dadosLinha['devolvidoStat'] == 0 ? "Não" : "Sim";
                                echo "<tr>";
                                    echo "<td>" . $dadosLinha["id"];
                                    echo "<td>". date("d-m",strtotime($dadosLinha["data"])) ."</td>";
                                    echo "<td>". $dadosLinha['horaRet'] ."</td>";
                                    echo "<td>". $devolvidoStat."</td>";
                                    echo "<td>".$dadosLinha['horaDevo']."</td>";
                                    echo "<td>".$dadosLinha['nomeProf']."</td>";
                                    echo "<td>".$dadosLinha['quantidade']."</td>";
                                echo "</tr>";
                                if($dadosLinha['nomeProf'] == $_SESSION['nome'] && $dadosLinha['devolvidoStat'] == 0){
                                    $pendDia = date("d-m",strtotime($dadosLinha["data"]));
                                    $pendencia = true;
                                    $pendId = $dadosLinha['id'];
                                    $pendQuant = $dadosLinha['quantidade'];

                                    $pendenciaArr = array($pendDia,$pendQuant);
                                    $_SESSION['pendencia'] = $pendenciaArr;	
                                }
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
                            <?php
                                    if ($pendencia == true){
                                        echo "<div class='chrAlug' style='background-color: whitesmoke;'>";
                                        echo "<h4 class='pendencia'> No dia ". $pendDia. " ficaram pendentes ". $pendQuant. " chromebooks" . "</h4>" . "<br>";
                                        echo "<h4 class=pendencia > id do pedido: ". $pendId. "</h4>";
                                        echo "<a href='./login/redef.html'> Em caso de erros relate aqui </a>";
                                        echo "</div>";
                                    }
                            ?>
            </div>
            <div class="functions">
                <button >Relatar problema em chromebook</button>
                <?php
                if($pendencia == true){
                    echo '<button id="devolution">Devolver chromebook</button>';
                }

                ?>
                <button id="require">Alugar chromebooks</button>
            </div>
        </div>
        <button id="sairDeFininho" style="background-color:red;height:fit-content; z-index:99;">Sair</button>
    </div>
</body>
<script src="script.js"></script>
</html>
