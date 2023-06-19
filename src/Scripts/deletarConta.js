let delButtons = document.getElementsByClassName("deletar-conta-botao");
let modalDeletar = document.querySelector(".modal-deletar-exterior");
let idClienteCamp = document.querySelector("#idDelCliente");
console.log(modalDeletar);

console.log(delButtons);

for(button of delButtons){
    button.addEventListener("click", abrirModalDeletar);
}

function abrirModalDeletar(e){
    let target = e.target;
    modalDeletar.classList.remove("hide");
    idClienteCamp.setAttribute("value", target.getAttribute("idCliente"));
    console.log(idClienteCamp);
}

function fecharModalDeletar(){
    modalDeletar.classList.add("hide");
}