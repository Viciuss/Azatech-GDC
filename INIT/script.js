const alugChr = document.querySelector("#require")
const sair = document.querySelector("#sairDeFininho")
const devolver = document.querySelector("#pendencia")
const newProf = document.querySelector("#novoFunc")


if(alugChr){ 
  alugChr.addEventListener("click", () =>{
    window.location.href = "../REQUIRE/requisição.php"
  })
}

if(newProf){
  newProf.addEventListener("click", () =>{
    window.location.href = "../USUARIOS/GerenciarUsuarios.php"
  })
}
sair.addEventListener("click", ()=>{
  window.location.href = "quit.php"
})
if(devolver){
  devolver.addEventListener("click", ()=>{
    window.location.href = "../DEVOLUCAO/devolucao.php"
  })
}

// Função para filtrar por data

const linhas = document.getElementById("tabelaHistorico").querySelectorAll("tr");
const pesquisar = document.querySelector("#update")  
const filtro = document.querySelector("#histD")

pesquisar.addEventListener("click", function() {
  const dataSelecionada = filtro.value.trim();

  linhas.forEach(linha => {
    const dataNaLinha = linha.children[1].textContent.trim(); // Coluna da data
    if (dataSelecionada === "" || dataNaLinha === dataSelecionada || dataNaLinha == "Data") {
      linha.style.display = ''; // Mostra
    } else {
      linha.style.display = 'none'; // Esconde
    }
  });
  console.log("Filtro aplicado: " + dataSelecionada);
})


// Funcão para filtrar por nome do professor
const pesquisarNome = document.querySelector("#pesquis")
const inputNome = document.querySelector("#pesquisae")

pesquisarNome.addEventListener("click", function() {
  const nomeProf = inputNome.value.toLowerCase();

  linhas.forEach(linha => {
    const nomeNaLinha = linha.children[5].textContent.toLowerCase(); // Coluna do nome
    if (nomeProf === "" || nomeNaLinha.includes(nomeProf) || nomeNaLinha === "professor") {
      linha.style.display = ''; // Mostra
    } else {
      linha.style.display = 'none'; // Esconde
    }
  });
  console.log("Filtro aplicado: " + nomeProf);
})
