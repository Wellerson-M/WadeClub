    <?php
session_start();
include "conexao.php";
if ($_SESSION["adm_usuario"] != 1) {
    header("location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  

  <title>Hello, world!</title>

</head>

<body><?php include "Components/nav.php"; ?>

<main>

    <nav aria-label="breadcrumb">
        <ol class="mx-5 mt-2 breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="tela_adm.php">Administrador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produtos</li>
        </ol>
    </nav>  

    <div class="box-search d-flex justify-content-center pt-2">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar2" name="pesquisar2">
        <button onclick="searchData2()" class="btn mx-1" style=" background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <a href="tela_adm.php" class="d-flex col-1" style="margin-left: 10%; margin-top:-2.5%;">
        <button type="button" class="btn btn-outline-primary">
            Voltar
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </button>
    </a>
    <div class="container mt-3">
        <table class="table table-hover" style=" background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">id_produto</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Preço</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            
              <tr>
                    <?php 
                    ////Barra de Pesquisa////
                        if(!empty($_GET['search']))
                        {
                            $data = $_GET['search'];
                            $comando = $pdo->prepare("SELECT * FROM produtos WHERE nome_produto LIKE '%$data%' or id_produto LIKE '%$data%' or categoria LIKE '%$data%'");

                            $comando->execute();

                            if ($comando->rowCount() >= 1) {
                                $listaItens = $comando->fetchAll();
                                
                            }
                        }else{
                            include("listar_produtos.php");
                        }

                        /////////////////////////
                        

                        if (!empty($listaItens)) {
                            foreach($listaItens as $linha) { 
                    ?>
                        <!-- <td><a style=" color:black;"  href="adm_informacoes.php?id_usuario=<?php //echo $linha['id_usuario'];?>"><?php// echo $linha['nome']; ?></a></td> -->
                        <td><a style=" color:black;"  href="adm_editar_produto.php?id_produto=<?php echo $linha['id_produto'];?>"><?php echo '<img height="100px"  class="" src="'.$linha['imagem'].'"></div>'?></a></td> 

                        <td><a style=" color:black;"  href="adm_editar_produto.php?id_produto=<?php echo $linha['id_produto'];?>"><?php echo $linha['id_produto']; ?></a></td>
                        <td><a style=" color:black;"  href="adm_editar_produto.php?id_produto=<?php echo $linha['id_produto'];?>"><?php echo $linha['nome_produto']; ?></a></td>
                        <td><?php echo $linha['categoria']; ?></td>
                        <td><?php echo "R$".$linha['preco']; ?></td>
                       
                        <td><a href="adm_excluir_produtos.php?id_produto=<?php echo $linha['id_produto'];?>" >
                          <button type="button" class="btn btn-outline" data-bs-toggle="tooltip" data-bs-placement="top"  title="Excluir usuário">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="" class="danger bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                          </button>
                        </a></td>
                    
              </tr>
            
              <?php }} ?>
            </tbody>
          </table>
  </main>

  
  
  
  
  
  
  
  
  
  
  
  
  <footer class=" border-top text-muted bg-light">
    <div class="coontainer">
      <div class="row py-3">
        <div class="col-12 col-md-4 text-center text-md-left">
          &copy; 2025 - WadeClub
        </div>
        <div class="col-12 col-md-4 text-center">
          <a href="#" class="text-decoration-none text dark">Politica de privacidade</a>
        </div> 
        <div class="col-12 col-md-4 text-center text-md-right">
          <?php if (!isset($_SESSION["id"]) and !isset($_SESSION["nome"])) {
              echo '<a href="#" class="text-decoration-none text dark">Termos de uso</a>';
          } else {
              if ($_SESSION["adm_usuario"] != 1) {
                  echo '<a href="#" class="text-decoration-none text dark">Termos de uso</a>';
              } else {
                  echo '<a href="tela_adm.php" class="text-decoration-none text dark">administrador</a>';
              }
          } ?>
        </div>
      </div>
    </div>

  </footer>
  

  <!-- Optional JavaScript -->
  <!-- Popper.js first, then Bootstrap JS -->
 

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>
    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event){
            if (event.key === "Enter")
            {
                searchData();
            }
        });

        function searchData()
        {
            window.location = 'categoria.php?search='+search.value;
        }
    </script>
    
</body>
</html>
