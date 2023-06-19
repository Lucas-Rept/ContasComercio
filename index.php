<?php
    require_once "autoload.php";
    use Borges\Comercial\Dominio\Model\Cliente;
    use Borges\Comercial\Infraestrutura\Persistencia\CriadorConexao;
    use Borges\Comercial\Infraestrutura\Repositorio\PdoRepositorioCliente;
    use Borges\Comercial\Dominio\Model\ClienteViewer;

    $repositorioCliente = new PdoRepositorioCliente(CriadorConexao::criarConexao());
    if(empty($_GET)){
        $clientes = $repositorioCliente->readAll();
    }
    else{
        $clientes = $repositorioCliente->readByName($_GET['nome']);
    }
    $viewer = new ClienteViewer();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/Style/index.css">
    <title>Contas | Comércio</title>
</head>
<body>
    <div class="page-container">
        <h1>Contas Comercial São Francisco</h1>
        <form method="GET" action="?">
            <div class="header-options">
                <input class="search-camp" type="text" placeholder="Digite o nome do cliente (Não coloque nada para pesquisar todos)" name="nome">
                <button class="search-button"><img class="search-icon" src="./src/Imagens/search.png" alt="icone de pesquisa"></button>
                <button class="add-button" onclick='abrirModal()' type="button"><span class='plus-icon'>+</span> Adicionar Conta</button>
            </div>
        </form>
        <ul class="clientes-lista">
            <?php
                foreach($clientes as $cliente){
                    $viewer->linkContaGen($cliente);
                }

                if(count($clientes) == 0){
                    echo "<h2>Nenhuma conta correspondente! (Pesquise Novamente!)</h2>";
                }
            ?>
        </ul>
    </div>

    <div class="modal-adicionar-exterior hide">
        <div class="modal-adicionar-interior">
            <h2>Adicionar Cliente</h2>
            <form action="adicionarCliente.php" method="POST">
                <input class="add-inputs next" type="text" placeholder="Nome do Cliente" id="modalClienteCampo" name="nome">
                <input class="add-inputs next" type="text" placeholder="Endereço do cliente" id="modalEnderecoCampo" name="endereco">
                <button class="buttons-modal" type="submit" id="modalAddButton">Adicionar</button>
                <button class="buttons-modal" onclick="fecharModal()" type="button">Fechar</button>
            </form>
        </div>
    </div>

    <div class="modal-deletar-exterior hide">
        <div class="modal-deletar-interior">
            <h2>Tem certeza disso?</h2>
            <form action="deletarCliente.php" method="POST">
                <input style="display: none;" name="id_cliente" value="" id="idDelCliente">
                <button class="buttons-modal" type="submit" id="modalDelButton">Sim</button>
                <button class="buttons-modal" onclick="fecharModalDeletar()" type="button">Não</button>
            </form>
        </div>
    </div>

    <script>
        let cliente = document.querySelector("#modalClienteCampo");
        let endereco = document.querySelector("#modalEnderecoCampo");
        let modal = document.querySelector(".modal-adicionar-exterior");
        let modalAddButton = document.querySelector("#modalAddButton");
        let nexts = document.querySelectorAll(".next");
        nexts.forEach(nexter => {
            nexter.addEventListener("keypress", next);
        });
        modalAddButton.addEventListener("click", verificacoes);

        function abrirModal(){
            modal.classList.remove("hide");
        }

        function fecharModal(){
            modal.classList.add("hide");
        }

        function verificacoes(e){
            if(cliente.value == "" || endereco.value == ""){
                e.preventDefault()
                alert("Nenhum dos campos pode estar vazio!");
            }
        }

        function next(e){
            if(e.key == "Enter"){
                e.preventDefault();
                e.target.nextElementSibling.focus();
            }
        }

    </script>
    <script src="./src/Scripts/deletarConta.js"></script>
</body>
</html>