const voltar = document.querySelector("#voltarDeFininho");
const linhas = document.getElementById("tabelaFuncionarios").querySelectorAll("tr");

const idInput = document.querySelector("#idFunc");
const nomeInput = document.querySelector("#nomeFunc");
const cpfInput = document.querySelector("#CPF");
const hierarquiaInput = document.querySelector("#hierarquia");

if (voltar) {
  voltar.addEventListener("click", () => {
    window.location.href = "../GerenciarUsuarios.php";
  });
}


var dadosEnviados = new FormData()

linhas.forEach(linha => {
  linha.addEventListener("click", function() {
    if(linha != linhas[0]){
        if (linha.classList.contains("selecionado")) {
        linha.classList.remove("selecionado");
        // Limpar os campos de entrada
        idInput.value = "";
        nomeInput.value = "";
        cpfInput.value = "";
        hierarquiaInput.value = "";
        
        // Enviar uma requisição AJAX para limpar os dados no PHP
        dadosEnviados.append("id", "");
        dadosEnviados.append("nome", "");
        dadosEnviados.append("CPF", "");
        dadosEnviados.append("hierarquia", "");

        $.ajax({
        method: "POST",
        url: "script.php",
        data: dadosEnviados,
        processData:false,
        contentType: false,
        }).done(function(response) {
            // Lógica para lidar com a resposta do PHP (opcional)
            console.log("Dados limpos com sucesso.");
        }).fail(function(jqXHR, textStatus, errorThrown) {
            // Lógica para lidar com erros na requisição
            console.error("Erro ao limpar dados: " + textStatus, errorThrown);
        });

        }else {
        // Remove a classe de seleção de todas as linhas
        linhas.forEach(l => l.classList.remove("selecionado"));
        // Adiciona a classe de seleção à linha clicada
        linha.classList.add("selecionado");
        

        // Atualizar dados dos campos de entrada com os dados da linha selecionada

        idInput.value = linha.children[0].textContent;
        nomeInput.value = linha.children[1].textContent;
        cpfInput.value = linha.children[2].textContent;
        hierarquiaInput.value = linha.children[3].textContent;

        dadosEnviados.append("id", linha.children[0].textContent);
        dadosEnviados.append("nome", linha.children[1].textContent);
        dadosEnviados.append("CPF", linha.children[2].textContent);
        dadosEnviados.append("hierarquia", linha.children[3].textContent);

        }
    }
  })
});


//pop-up

const modal = document.querySelector('.modal-container')

function openModal() {
  modal.classList.add('active')
}

function closeModal() {
  modal.classList.remove('active')
}


const chamaAe = document.querySelector('#enviarForm')

chamaAe.addEventListener("click",function(){
  if(idInput.value == ""){ 
    document.querySelector("#textoConfirm").innerHTML = "Por favor, selecione na tabela abaixo o funcionário que deve ser retirado do sistema"
    document.querySelector(".btnOK").addEventListener("click",closeModal)

    openModal()
  }else{
    document.querySelector("#textoConfirm").innerHTML = "Você deseja remover o " + hierarquia.value + ": " + nomeFunc.value + " Com o ID: " + idInput.value + " e o CPF: " + cpfInput.value + "?"
    document.querySelector(".btnOK").addEventListener("click",deletarFuncionario)
    openModal()
  }


})

// confirmação do envio dos dados


function deletarFuncionario(){
        dadosEnviados.append("confirm", true);

        $.ajax({
        method: "POST",
        url: "script.php",
        data: dadosEnviados,
        processData:false,
        contentType: false,
        }).done(function(response) {
            // Lógica para lidar com a resposta do PHP (opcional)
            atualizarTabela(response)







          closeModal()
        }).fail(function(jqXHR, textStatus, errorThrown) {
            // Lógica para lidar com erros na requisição
            console.error("Erro ao enviar dados: " + textStatus, errorThrown);


        });


}



function atualizarTabela(dados) {
  const tabela = document.getElementById("tabelaFuncionarios");
  const corpo = tabela.querySelector("tbody");


  corpo.innerHTML = "";


  dados.forEach(funcionario => {
    const linha = document.createElement("tr");

    funcionario.forEach(info => {
      const celula = document.createElement("td");
      celula.textContent = info;
      linha.appendChild(celula);
    });


    linha.addEventListener("click", () => {
      const [id, nome, cpf, hierarquia] = funcionario;


      idInput.value = id;
      nomeInput.value = nome;
      cpfInput.value = cpf;
      hierarquiaInput.value = hierarquia;


      document.querySelectorAll("#tabelaFuncionarios tr").forEach(l => l.classList.remove("selecionado"));
      linha.classList.add("selecionado");
    });

    corpo.appendChild(linha);
  });
}



const pesquisarNome = document.querySelector("#pesquis")
const inputNome = document.querySelector("#pesquisae")

pesquisarNome.addEventListener("click", function() {
  const nomeProf = inputNome.value.toLowerCase();

  linhas.forEach(linha => {
    const nomeNaLinha = linha.children[1].textContent.toLowerCase(); // Coluna do nome
    if (nomeProf === "" || nomeNaLinha.includes(nomeProf) || nomeNaLinha === "nome") {
      linha.style.display = ''; // Mostra
    } else {
      linha.style.display = 'none'; // Esconde
    }
  });
  console.log("Filtro aplicado: " + nomeProf);
})