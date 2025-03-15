const reg = document.getElementById("tabela")
const btn = document.getElementById("pesquis")


function criarRegistro(nome, quantidade, entregue){
    
    const nReg = document.createElement("tr")
    
    const newContent = document.createTextNode("Hi there and greetings!");
    
    
    
    //Criar linha da tabela -> criar itens da tabela



    var nome_dobuxa = document.createElement('td')
    var quant = document.createElement("td")

    nome_dobuxa.innerHTML = "AAAAAAA"
    quant.innerHTML = 20
    

    nReg.appendChild(nome_dobuxa)
    nReg.appendChild(quant)
    
    reg.appendChild(nReg)
}

btn.addEventListener("click",() => {    
    for(let i = 0 ; i <= 10; i++){
        criarRegistro()
    }
})