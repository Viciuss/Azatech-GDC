const voltar = document.querySelector("#voltarDeFininho");
const addFuncionario = document.querySelector("#addFuncionario");
const deleteFuncionario = document.querySelector("#deleteFuncionario");

if (voltar) {
  voltar.addEventListener("click", () => {
    window.location.href = "../INIT/gdc.php";
  });
}

addFuncionario.addEventListener("click", () => {
  window.location.href = "cadastro/cadastro.html";
})

deleteFuncionario.addEventListener("click", () => {
  window.location.href = "deletar/deletarFuncionario.php";
})



const linhas = document.getElementById("tabelaFuncionarios").querySelectorAll("tr");




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