<?php

include("conexao.php");

$comando = $pdo->prepare("SELECT * FROM produtos WHERE id_produto = $id_produto");

$comando->execute();

if ($comando->rowCount() >= 1) {
    $listaItens = $comando->fetchAll();
    
    
} else {
    echo("Não há itens cadastradosss");
}
