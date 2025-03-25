const alugChr = document.querySelector("#require")
const sair = document.querySelector("#sairDeFininho")

alugChr.addEventListener("click", () =>{
    window.location.href = "require/requisição.php"
})


sair.addEventListener("click", ()=>{
    window.location.href = "quit.php"
})