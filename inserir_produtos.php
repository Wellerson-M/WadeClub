<?php
    include("conexao.php");

    $nome_produto = $_POST["nome_produto"];
    $categoria = $_POST["categoria"];
    $marca = $_POST["marca"];
    $preco = $_POST["preco"];
    $imagem = $_FILES['imagem']; 
    $extensao = $imagem['type'];
    $conteudo = file_get_contents($imagem['tmp_name']);
    $base64 = "data:".$extensao.";base64,".base64_encode($conteudo);

    $comando = $pdo -> prepare("INSERT INTO produtos(nome_produto, categoria, marca, preco, imagem) VALUES(:nome_produto, :categoria, :marca, :preco, :conteudo)");

    $comando->bindValue(":nome_produto",$nome_produto);    
    $comando->bindValue(":categoria",$categoria);                                  
    $comando->bindValue(":marca",$marca);                                  
    $comando->bindValue(":preco",$preco);                                  
    $comando->bindValue(":conteudo", $base64);

    $comando->execute();

    header("Location:cadastro_produtos.php");

    //Fecha declaração e conexão.
    unset($comando);
    unset($pdo);