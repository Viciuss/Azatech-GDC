const voltar = document.querySelector("#voltarDeFininho");
const addFuncionario = document.querySelector("#addFuncionario");
const deleteFuncionario = document.querySelector("#deleteFuncionario");

if (voltar) {
  voltar.addEventListener("click", () => {
    window.location.href = "../GerenciarUsuarios.php";
  });
}