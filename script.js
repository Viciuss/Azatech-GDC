const alugChr = document.querySelector("#require")
const sair = document.querySelector("#sairDeFininho")
const devolver = document.querySelector("#devolution")
const pesquisar = document.querySelector("#update")  
const filtro = document.querySelector("#histD")


if(alugChr){ 
  alugChr.addEventListener("click", () =>{
    window.location.href = "require/requisição.php"
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

  document.getElementById('update').addEventListener('click', function () {
    const dataSelecionada = document.getElementById('histD').value;
    const linhas = document.querySelectorAll('#histTable tr');

    linhas.forEach(linha => {
        const dataNaLinha = linha.children[1].textContent.trim(); // Coluna da data
        if (dataSelecionada === "" || dataNaLinha === dataSelecionada) {
            linha.style.display = ''; // Mostra
        } else {
            linha.style.display = 'none'; // Esconde
        }
    });
});