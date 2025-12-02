<?php
   session_start();
   include("conexao.php");

   
   $id_produto = $_POST["id_produto"];
   $tamanho = $_POST["tamanho"];
   $quantidade = $_POST["quantidade"];

   var_dump ($id_produto);
   
   $id_usuario = $_SESSION['id_usuario'];
   var_dump ($id_usuario);
    
   $query = $pdo->prepare("SELECT preco FROM produtos WHERE id_produto = $id_produto");
   $query->execute();
   

   if ($query->rowCount() >= 1) {
      $listaItens = $query->fetchAll();
      if (!empty($listaItens)) {
         foreach($listaItens as $linha) { 
 
      $valor_final = ($linha['preco']*$quantidade);
      $comando = $pdo -> prepare("INSERT INTO carrinho(id_usuario, id_produto, tamanho, quantidade, valor_final)
      VALUES(:id_usuario, :id_produto, :tamanho, :quantidade, :valor_final)");
      
      $comando->bindValue(":id_usuario",$id_usuario);    
      $comando->bindValue(":id_produto",$id_produto);  
      $comando->bindValue(":tamanho",$tamanho);  
      $comando->bindValue(":quantidade",$quantidade);     
      $comando->bindValue(":valor_final",$valor_final); 
      $comando->execute();   
  
      header("location:carrinho.php");

      unset($query);
      unset($comando);
      unset($pdo);
  }}} else {
      echo("Não há itens cadastradosss");
  }
