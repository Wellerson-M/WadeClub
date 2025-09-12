<?php
session_start();
include "conexao.php";
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

<body>
<!-- rodapé superior -->
  <nav class=" navbar  navbar-expand-lg navbar-dark bg-primary border-bottom shadow-sm ">
    <div class="container-fluid">
        <div class="d-none d-md-block">
            <a href="Untitled-1.php"> <img class="pt-2 invisible" src="" width="150px" height="95px"></a>
        </div>

        <div class="box-search d-flex justify-content-center pt-2 col">
            <input class=" form-control me-2" type="search" placeholder="O que você está procurando?" id="pesquisar" name="pesquisar" class="">
        </div>


        <div class="align-self end ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse">


                <ul class="navbar-nav">
                
                  <?php if (
                      !isset($_SESSION["id"]) and !isset($_SESSION["nome"])
                  ) { ?>
                    <li class="nav-item">
                        <a href="login.html" class="m-2 nav-link  text-white"> Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="cadastro.html" class="m-2 nav-link  text-white"> Cadastrar</a>
                    </li>
                    <?php } else { ?>
                      <li class="nav-item">
                        <a href="#" class="m-2 nav-link  text-white"> Bem vindo <?php echo $_SESSION[
                            "nome"
                        ]; ?></a>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
        
    </div>
  </nav>
<!----  ------->


<!-- menu de pesquisa: home, categoria, fav. carrinho -->
  <ul class="sticky-top nav nav-pills nav-fill navbar-light bg-light border">
      <li class="nav-item d-none d-md-block">
          <a class="nav-link " aria-current="page" href="Untitled-1.php" tabindex="-1" aria-disabled="true">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house"
                  viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                      d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                  <path fill-rule="evenodd"
                      d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
              </svg><strong>Home</strong></a>
      </li>
      <li class="nav-item d-none d-md-block">
          
          <a class="nav-link" href="categoria.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-radios-grid" viewBox="0 0 16 16">
              <path d="M3.5 15a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm9-9a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 9a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zM16 3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0zm-9 9a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0zm5.5 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zm-9-11a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 2a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
          <strong>Categoria</strong></a>
      </li>
      <li class="nav-item d-none d-md-block">
          <a class="nav-link" href="favoritos.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart"
                  viewBox="0 0 16 16">
                  <path
                      d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
              </svg><strong>Lista de desejos</strong></a>
      </li>
      <li class="nav-item d-none d-md-block">
          <a class="nav-link " href="carrinho.php" tabindex="-1" aria-disabled="true">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart3"
                  viewBox="0 0 16 16">
                  <path
                      d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </svg><strong>Carrinho</strong> </a>
      </li>

      <li class="nav-item d-inline-block d-md-none">
          <a class="nav-link disabled" aria-current="page" href="#" tabindex="-1" aria-disabled="true">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house"
                  viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                      d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                  <path fill-rule="evenodd"
                      d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
              </svg></a>
      </li>
      <li class="nav-item d-inline-block d-md-none">
          <a class="nav-link text-dark" href="#">

              <a class="nav-link text-dark" href="#"><img id="chuteira-icon" src="img/vans-svgrepo-com.svg" class="bi " width="20" height="20" ></a>
      </li>
      <li class="nav-item d-inline-block d-md-none">
          <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart"
                  viewBox="0 0 16 16">
                  <path
                      d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
              </svg></a>
      </li>
      <li class="nav-item d-inline-block d-md-none">
          <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart3"
                  viewBox="0 0 16 16">
                  <path
                      d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </svg> </a>
      </li>
  </ul>
  <!----  ------->
  
  <!-- banners -->
  <header class="container pt-2">
    <div id="carouselMain" class="carousel carousel-dark slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselMain" data-slide-to="0" class="active"></li>
        <li data-target="#carouselMain" data-slide-to="1" class="active"></li>
        <li data-target="#carouselMain" data-slide-to="2" class="active"></li>
      </ol>
      <div class="carousel-inner ">
        <div class="carousel-item active text-center" data-interval="3000">
          <img src="img/UseWade.jpg" height="1200px"  alt="" class="img-fluid d-block">
          
        </div>
        <div class="carousel-item text-center" data-interval="3000">
        <img src="img/UseWade.jpg" height="1200px" alt="" class="img-fluid d-block">

        </div>
        <div class="carousel-item text-center" data-interval="3000">
           <img src="img/UseWade.jpg" height="1200px" alt="" class="img-fluid d-block">

        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselMain" role="button" data-slide="prev">
        <span class="dark carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden"></span>
      </a>
      <a class="carousel-control-next " href="#carouselMain" role="button" data-slide="next">
        <span class="visually-hidden"></span>
        <span class="carousel-control-next-icon"></span>
        
      </a>
    </div>
    <hr class="mt-3" >
    <section class="container d-none d-xl-block">
      
      <section class="row">
        
      </section>       

  </header>
<!----  ------->

  <main>
    <div class="container">

      <div class="row">
      <div class="col-12 col-md-5 invisible">
        <form class="justify-content-center justify-content-md-start mb-3 mb-md-0">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control" placeholder="digite aqui o que procura">
            <button class="btn btn-primary">
              Buscar
            </button>
          </div>
        </form>
      </div>

      <div class="col-12 col-md-7">
        <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
          <form class="ml-3 d-inline-block">
            <select class="form-select form-select-sm">
              <option>Ordernar pelo nome</option>
              <option>Ordernar pelo menor preço</option>
              <option>Ordernar pelo maior preço</option>
            </select>
          </form>
          <nav class="d-inline-block">
            <ul class="pagination pagination-sm my-0">              
              <li class="page-item disabled">
                <button class="page-link">1</button>
              </li>
              <li class="page-item">
                <button class="page-link">2</button>
              </li>
              <li class="page-item">
                <button class="page-link">3</button>
              </li>
              <li class="page-item">
                <button class="page-link">4</button>
              </li>
              <li class="page-item">
                <button class="page-link">5</button>
              </li>
              <li class="page-item">
                <button class="page-link">...</button>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      

      </div>
      <hr class="mt-3 " >
      <div class="row ">

        <?php
        ////Barra de Pesquisa////
                        

        // listar produtos, um por um.
        if (!empty($listaItens)) {
            foreach ($listaItens as $linha) {
                $id_produto = $linha["id_produto"]; ?>
        
        
        <?php
            }
        }
        ?>           

        <div class="col-12 col-md-5 invisible">
          <form class="justify-content-center justify-content-md-start mb-3 mb-md-0">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="digite aqui o que procura">
              <button class="btn btn-primary">
                Buscar
              </button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
    
    
  </main>

  <footer class=" border-top text-muted bg-light">
    <div class="coontainer">
      <div class="row py-3">
        <div class="col-12 col-md-4 text-center text-md-left">
          &copy; 2022 -
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