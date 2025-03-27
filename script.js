const alugChr = document.querySelector("#require")
const sair = document.querySelector("#sairDeFininho")
const devolver = document.querySelector("#devolution")    


alugChr.addEventListener("click", () =>{
    window.location.href = "require/requisição.php"
})


sair.addEventListener("click", ()=>{
    window.location.href = "quit.php"
})

devolver.addEventListener("click", ()=>{
    window.location.href = "require/devolver.php"
    console.log("devolver")
})