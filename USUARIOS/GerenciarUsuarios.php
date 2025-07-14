<?php
session_start();
if (!isset($_SESSION['cpf']) || !isset($_SESSION['id']) || !isset($_SESSION['funcao']) || $_SESSION['funcao'] == 'Professor') {
    header("Location: ../LOGIN/login.html");
    exit();
}else{
    include_once '../LOGIN/validation/connect.php';
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="GerenciarUsuarios.css">
</head>
<body>
    <header>
        <div class="logo">
            <div class="placeholder"></div>
        </div>
        <h1>GDC</h1>
        <button class="button" id="voltarDeFininho">Voltar</button>
    </header>

    <main>
        <section class="menu funcionarios">
                <h1>Tabela de Funcionários</h1>
                <div class="pesquisa">
                    <input type="text" name="pesquisa" id="pesquisae" placeholder="Pesquisar professor">
                    <button id="pesquis" class="button tipoDois">Pesquisar</button>
                </div>

                <div class="tabelaFuncionarios">
                    <table id="tabelaFuncionarios">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Cargo</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaUsuarios">
                            
                        <?php
                        $quantidadeFuncs = 0;
                        $quantidadeProfessores = 0;

                            $sql ="SELECT * FROM LoginFunc";
                            $result = $connect->query($sql);

                            while($dadosLinha = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td>" . $dadosLinha["IDFunc"] . "</td>";
                                echo "<td>".$dadosLinha['nomeFunc']."</td>";
                                echo "<td>".$dadosLinha['CPF']."</td>";
                                echo "<td>".$dadosLinha['hierarquia']."</td>";
                                echo "</tr>";
                                

                                $quantidadeFuncs++;
                                if($dadosLinha['hierarquia'] == 'Professor'){
                                    $quantidadeProfessores++;
                                }
                            }
                                ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="menu info">
                    <h1>Dados e Informações</h1>
                    <div class="dados">
                        <h3>Quantidade de Funcionários: <?php echo $quantidadeFuncs?> </h3>
                        <h3>Quantidade de Professores: <?php echo $quantidadeProfessores?></h3>
                        <h3>Quantidade de Computadores: <span></span></h3>
                    </div>
                    
                    <div class="funcoes">
                        <button id="addFuncionario" class="button tipoDois">Adicionar Funcionário</button>
                        <button id="deleteFuncionario" class="button tipoUm">Remover Funcionário</button>
                    </div>
            </section>

        </main>     
</body>
<script src="script.js"></script>
</html>