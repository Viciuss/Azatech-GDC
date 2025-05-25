const alugChr = document.querySelector("#require")
const sair = document.querySelector("#sairDeFininho")
const devolver = document.querySelector("#devolution")
const pesquisar = document.querySelector("#update")  
const filtro = document.querySelector("#histD")
const newProf = document.querySelector("#addProf")


if(alugChr){ 
  alugChr.addEventListener("click", () =>{
    window.location.href = "require/requisição.php"
  })
}

if(newProf){
newProf.addEventListener("click", () =>{
    window.location.href = "login/cadastro/cadastro.html"
})
}

sair.addEventListener("click", ()=>{
    window.location.href = "quit.php"
})
if(devolver){
    devolver.addEventListener("click", ()=>{
        window.location.href = "require/devolver.php"
    })
  }




  

function escondae(btn) {
    const div = document.querySelector(".registro");
    const img = btn.querySelector("img");
  
    if (div.classList.contains("saindo")) {
      div.classList.remove("saindo");
      img.src = "imgs/illuminati.png";
      img.alt = "illuminati";
    } else {
      div.classList.add("saindo");
      img.src = "imgs/itanimulli.png";
      img.alt = "itanimulli";
    }
  }








  const linhas = document.querySelectorAll('#histTable tr');

  document.getElementById("pesquis").addEventListener("click", function() {
    const nomeProf = document.getElementById("pesquisae").value.toLowerCase();

    linhas.forEach(linha => {
        const nomeNaLinha = linha.children[5].textContent.toLowerCase(); // Coluna do nome
        if (nomeProf === "" || nomeNaLinha.includes(nomeProf)) {
            linha.style.display = ''; // Mostra
        } else {
            linha.style.display = 'none'; // Esconde
        }
    });


  })





  document.getElementById('update').addEventListener('click', function () {
    const dataSelecionada = document.getElementById('histD').value;

    linhas.forEach(linha => {
        const dataNaLinha = linha.children[1].textContent.trim(); // Coluna da data
        if (dataSelecionada === "" || dataNaLinha === dataSelecionada) {
            linha.style.display = ''; // Mostra
        } else {
            linha.style.display = 'none'; // Esconde
        }
    });
});