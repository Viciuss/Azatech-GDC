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
</head>
<body>
    <div class="geral">
        <button type="button" onclick="escondae(this)" class="escondae"><img src="imgs/itanimulli.png" alt=""></button>
        <div class="registro ">
            <div class="top-panel">
                
                </div>
                <div class="carregamento">
                    <h1>Status de carregamento</h1>
                </div>

                
                
            </div>
            <div class="centro">
                <div class="barraPesq">
                    <input type="text" name="pesquisa" id="pesquisae" placeholder="Pesquisar professor">
                    <button id="pesquis">Pesquisar</button>
                </div>
            <div id="histDia">
                <select name="histDia" id="histD">
                    <option value="">Mostrar tudo</option>
                <?php
                    
                        $datas_exibidas = array(); // Array para guardar as datas já exibidas

                        while($diaD = $result->fetch_assoc()) {
                            $data_formatada = date("d-m", strtotime($diaD['data']));

                            if (!in_array($data_formatada, $datas_exibidas)) {
                                echo "<option value='" . $data_formatada . "'>" . $data_formatada . "</option>";
                                $datas_exibidas[] = $data_formatada; // Adiciona a data ao array
                            }
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
                    <h2 class="hierarquia"><?php 
                        switch ($_SESSION['hierarquia']) {
                            case 0:
                            echo "Professor";
                            break;
                            case 1:
                            echo "Diretor";
                            break;
                            case 2:
                            echo "Nerd da TI";
                            break;
                            default:
                            echo "Erro";
                        }
                        ?></h2>
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
                }else{
                    echo "<button id='require'>Alugar chromebooks</button>";
                }
                if($_SESSION['hierarquia'] == 1 || $_SESSION['hierarquia'] == 2){
                    echo '<button id="addProf">Adicionar professor</button>';
                }
                
                
                ?>
            </div>
        </div>
        <button id="sairDeFininho" style="background-color:#ad0013;height:fit-content; z-index:99;">Sair</button>
    </div>
</body>
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
</html>
