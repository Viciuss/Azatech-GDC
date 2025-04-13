const alugChr = document.querySelector("#require")
const sair = document.querySelector("#sairDeFininho")
const devolver = document.querySelector("#devolution")    


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