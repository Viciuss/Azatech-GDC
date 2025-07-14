<?php
session_start();
if (!isset($_SESSION['cpf']) || !isset($_SESSION['id']) || !isset($_SESSION['funcao'])) {
    header("Location: ../LOGIN/login.html");
    exit();
}else{
    include_once '../LOGIN/validation/connect.php';
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDC</title>
</head>
<body>
    <header>
        <div class="logo">
            <div class="placeholder"></div>
        </div>
        <h1>GDC</h1>
        <button class="button" id="sairDeFininho">Sair</button>
    </header>
    <main>
        <section class="menu wms">
            <h1>Histórico de retiradas</h1>
            <div class="pesquisa">
                <input type="text" name="pesquisa" id="pesquisae" placeholder="Pesquisar professor">
                <button class="button tipoDois" id="pesquis">Pesquisar</button>
            </div>
            
            <div id="histDia" class="filtro">
                <label for="histD">Filtrar por data:</label>
                <select name="histDia" id="histD">
                    <option value="">Mostrar tudo</option>
                    <?php
                        $datas_exibidas = array(); // Array para guardar as datas já exibidas
                        $sql = "SELECT DISTINCT DATE_FORMAT(dataPedido, '%d-%m') AS data_formatada FROM requisicoes";
                        $result = $connect->query($sql);
                        
                        while ($diaD = mysqli_fetch_assoc($result)) {
                            $data_formatada = $diaD['data_formatada'];
                            if (!in_array($data_formatada, $datas_exibidas)) {
                                echo "<option value='" . $data_formatada . "'>" . $data_formatada . "</option>";
                                $datas_exibidas[] = $data_formatada; // Adiciona a data ao array
                            }
                        }
                    ?>
                </select>
                <button id="update">Pesq</button>
            </div>
            <div class="tabelaHistorico">
                <table id="tabelaHistorico">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Data</th>
                            <th>Hora de retirada</th>
                            <th>Hora de devolução</th>
                            <th>Devolvido?</th>
                            <th>Professor</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql ="SELECT * FROM requisicoes INNER JOIN LoginFunc ON requisicoes.IDFunc = LoginFunc.IDFunc";
                            $result = $connect->query($sql);
                            
                            
                            
                            
                            
                            while($dadosLinha = mysqli_fetch_assoc($result)){
                                $devolvidoStat = $dadosLinha['statusDevo'] == 0 ? "Não" : "Sim";
                                echo "<tr>";
                                echo "<td>" . $dadosLinha["IDPedido"];
                                echo "<td>". date("d-m",strtotime($dadosLinha["dataPedido"])) ."</td>";
                                echo "<td>". $dadosLinha['horaPedido'] ."</td>";
                                echo "<td>".$dadosLinha['horaDevolucao']."</td>";
                                echo "<td>". $devolvidoStat."</td>";
                                echo "<td>".$dadosLinha['nomeFunc']."</td>";
                                echo "<td>".$dadosLinha['quantidade']."</td>";
                                echo "</tr>";
                                    if($dadosLinha['nomeFunc'] == $_SESSION['nome'] && $dadosLinha['statusDevo'] == 0){
                                        $pendDia = date("d-m",strtotime($dadosLinha["dataPedido"]));
                                        $pendencia = true;
                                        $pendId = $dadosLinha['IDPedido'];
                                        $pendQuant = $dadosLinha['quantidade'];
                                        
                                        $pendenciaArr = array($pendDia,$pendQuant);
                                        $_SESSION['pendencia'] = $pendenciaArr;	
                                    }
                                }
                                ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <section class="menu erp">
            <h1>Controle de perfil</h1>
            <div class="imgPerf">
                <div class="cabeca"></div>
                <div class="corpo"></div>
            </div>
            <div class="infoPerf">
                <?php
                        echo "<h1>" . $_SESSION['nome'] . "</h1>";
                        echo "<h2>" . $_SESSION['cpf'] . "</h2>";
                        echo "<h2>" . $_SESSION['funcao'] . "</h2>";
                        
                        if(isset($pendencia)){
                            echo "<div class='pendencia'>";
                            echo "<h2>Você tem uma pendência de devolução do dia " . $pendenciaArr[0] . " referente a " . $pendenciaArr[1] . " chromebooks.</h2>";
                            echo "</div>";
                        }
                        ?>
                </div>
                <div class="functions">
                    <button class="button tipoUm">Relatar Problema em chromebook</button>
                    <?php
                    if ($_SESSION['funcao'] != 'Professor') {
                        echo '<button class="button tipoDois" id="novoFunc">Gerenciar Usuários</button>';
                    }
                    if ($_SESSION['funcao'] == 'Professor' || $_SESSION['funcao'] == 'TI' && !isset($pendencia)) {
                        echo '<button class="button tipoDois" id="require">Alugar Chromebook</button>';
                    }
                    if (isset($pendencia)) {
                        echo '<button class="button tipoDois" id="pendencia">Devolver Chromebook</button>';
                    }
                    
                    
                    ?>
                </div>
                
            </section>
            
            

            
            
        </main>
        <footer>
            <p>&copy; 2023 GDC. All rights reserved.</p>
        </footer>
    </body>
    
    <script src="script.js"></script>
    <link rel="stylesheet" href="gdc.css">
    </html>