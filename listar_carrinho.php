<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include("conexao.php");

$id_usuario = $_SESSION['id_usuario'] ?? null;

if ($id_usuario) {
    $comando = $pdo->prepare("SELECT * FROM carrinho 
        RIGHT JOIN produtos ON carrinho.id_produto = produtos.id_produto 
        WHERE carrinho.id_usuario = ?");
    $comando->execute([$id_usuario]);

    if ($comando->rowCount() >= 1) {
        $listaItens = $comando->fetchAll();
        // Aqui você pode iterar com foreach e exibir os produtos
    } else {
        echo "Não há itens no seu carrinho.";
    }
} else {
    echo "Usuário não autenticado.";
}
