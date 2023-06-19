<?php

require_once "autoload.php";

use Borges\Comercial\Dominio\Model\Cliente;
use Borges\Comercial\Dominio\Model\Produto;
use Borges\Comercial\Dominio\Model\ProdutoViewer;
use Borges\Comercial\Infraestrutura\Persistencia\CriadorConexao;
use Borges\Comercial\Infraestrutura\Repositorio\PdoRepositorioCliente;
use Borges\Comercial\Infraestrutura\Repositorio\PdoRepositorioProduto;

if(isset($_GET)){
    $id = $_GET['id'];
}

$repositorio = new PdoRepositorioCliente(CriadorConexao::criarConexao());
$cliente = new Cliente($id, "Sem nome", "Endereço Nulo");
$repositorio->read($cliente);

$repositorioProduto = new PdoRepositorioProduto(CriadorConexao::criarConexao());
$produtoViewer = new ProdutoViewer();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta</title>
    <link rel="stylesheet" href="./src/Style/paginaCliente.css">
</head>
<body>
    <div class="page-container" id="contentPdf">
        <a href="./index.php" data-html2canvas-ignore="true">Voltar</a>
        <h1>Conta Cliente Comercial São Francisco</h1>
        <div class="header-options">
            <div class="cliente-info">
                <h2>Nome: <?php echo $cliente->getNome()?></h1>
                <h2>Endereço: <?php echo $cliente->getEndereco() ?></h2>
                <h2>Data da Conta: <?php echo $cliente->getDataConta() ?></h2>
            </div>
            <button class="add-produto-button"  data-html2canvas-ignore="true" onclick="abrirModal()"><span class="plus-icon">+</span>Adicionar Produto</button>
        </div>

        <table>
            <ul>
                <?php

                    $produtos = $repositorioProduto->readAllCliente($id);
                    $soma = 0;

                    echo "<li class='detalhes-produto header-list'><span class='quantidade-produto'>Qtd</span> <span class='nome-produto'>Nome do Produto</span> <span class='preco-produto'>Preço</span> <span class='data-produto'>Data</span></li>";

                    foreach($produtos as $produto){
                        $soma += $produtoViewer->listItemProduto($produto);
                    }
                    
                    $somaString = number_format($soma, 2, ",", "");
                    echo "<li class='total'><span class='totalPreco'>Total: R$ $somaString</span></li>";
                ?>
            </ul>
        </table>

        
        <button class="buttons-default" id="generatePdf" data-html2canvas-ignore="true">Imprimir/Gerar PDF</button>
    </div>

    <div class="modal-adicionar-exterior hide">
        <div class="modal-adicionar-interior">
            <h2>Adicionar Produto</h2>
            <form action="adicionarProduto.php" method="POST">
                <input class="hide" type="number" value="<?php echo $id?>" name="id_cliente">
                <input class="add-inputs next" type="text" placeholder="Nome do Produto" id="modalNomeCampo" name="nome">
                <input class="add-inputs next" type="number" step = 0.10 placeholder="Quantidade" id="modalQuantidadeCampo" name="quantidade">
                <input class="add-inputs next" type="number" step = 0.05 placeholder="Preço do produto" id="modalPrecoCampo" name="preco">
                <button class="buttons-modal" type="submit" id="modalAddButton">Adicionar</button>
                <button class="buttons-modal" onclick="fecharModal()" type="button">Fechar</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./src/Scripts/gerarPdf.js"></script>

    <script>

        let produto = document.querySelector("#modalNomeCampo");
        let preco = document.querySelector("#modalPrecoCampo");
        let quantidade = document.querySelector("#modalQuantidadeCampo");
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
            if(produto.value == "" || preco.value == "" || quantidade.value == ""){
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
</body>
</html>