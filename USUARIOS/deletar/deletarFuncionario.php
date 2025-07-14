<?php
session_start();
if (!isset($_SESSION['cpf']) || !isset($_SESSION['id']) || !isset($_SESSION['funcao']) || $_SESSION['funcao'] == 'Professor') {
    header("Location: ../LOGIN/login.html");
    exit();
}else{
    include_once '../../LOGIN/validation/connect.php';
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="deletarFuncionario.css">
</head>
<body>
    <header>
        <div class="logo">
            <div class="placeholder"></div>
        </div>
        <h1>GDC</h1>
        <button class="button" id="voltarDeFininho">Voltar</button>
    </header>

    <div class="modal-container">
        <div class="modal">
            <div class="fundo-texto">
                <h2>Info</h2>
                <span>
                    <p id="textoConfirm">Você tem certeza que deseja marcar como devolvido?
                        Essa ação não pode ser desfeita.
                        Após clicar em OK, o pedido será marcado como devolvido e não poderá ser alterado.</p>
                </span>
                <div class="btns">
                    <button class="btnOK" type="button" name="submit">OK</button>
                    <button class="btnClose" type="button" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

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
                                if($dadosLinha["IDFunc"] != $_SESSION["id"]){

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
                            }
                                ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="menu delete">
                <h1>Deletar Funcionário</h1>
                <form class="formularioDeletar" id="formularioDeletar">
                    <div class="inputs">
                        <input type="text" id="idFunc" placeholder=" " name="idFunc" disabled>
                        <label for="idFunc">ID do Funcionário:</label>
                    </div>
                    <div class="inputs">
                        <input type="text" id="nomeFunc" placeholder=" " name="nomeFunc" disabled>
                        <label for="nomeFunc">Nome:</label>
                    </div>
                    <div class="inputs">
                        <input type="number" id="CPF"  placeholder=" " name="CPF" disabled>
                        <label for="CPF">CPF:</label>
                    </div>
                    <div class="inputs">
                        <input id="hierarquia"  placeholder=" " name="hierarquia" disabled>
                        <label for="hierarquia">Hierarquia:</label>
                    </div>
                    <button type="button" id="enviarForm" class="button tipoUm">Deletar</button>
                </form>    
            </section>
        </main>     
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="script.js"></script>
<link rel="stylesheet" href="modal.css">
</html>