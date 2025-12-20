  
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    </script>

  <title>WadeClub</title>

</head>

<body><?php include "Components/nav.php"; ?>

<div class="container-fluid">
   <?php 
        $id_produto = $_GET['id_produto'];
        $comando = $pdo->prepare("SELECT * FROM produtos WHERE id_produto = $id_produto" );

        $comando->execute();

        if ($comando->rowCount() >= 1) {
            $listaItens = $comando->fetch(PDO::FETCH_ASSOC);
        }
    
    ?>

    <main>
        <nav aria-label="breadcrumb">
            <ol class="mx-5 mt-2 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrinho</li>
            </ol>
        </nav>

        <div class="container">
                <div class="m-3 card">
                    <div class=d-flex>
                        <div class="card shadow " style="width: 250px; height: auto">
                            <img src="<?php echo $listaItens['imagem']; ?>" class="rounded mx-auto d-block" style="width: 100%; height: auto; display: block;">
                        </div>
                        <div class="d-block">
                            <h3 class="mx-5 my-3">Editar produto:</h3>
                            <input type="file" class="mx-5 my-2">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col mx-2">
                            <label class="fs-5" for="nome">Nome produto: </label>
                            <input type="text" class="form-control" name="nome" value="<?php echo $listaItens['nome_produto']; ?>">
                        </div>
                        <div class="col mx-2">
                            <label class="fs-5" for="categoria">Categoria: </label>
                            <input type="text" class="form-control" name="categoria" value="<?php echo $listaItens['categoria']; ?>">
                        </div>
                    </div>
                    <div class="d-flex my-3">
                        <div class="col mx-2">
                            <label class="fs-5" for="marca">Marca: </label>
                            <input type="text" class="form-control" name="marca" value="<?php echo $listaItens['marca']; ?>">
                        </div>
                        <div class="col mx-2">
                            <label class="fs-5" for="preco">Preço: </label>
                            <input type="text" class="form-control" name="preco" value="<?php echo $listaItens['preco']; ?>">
                        </div>
                    </div>
                    <input type="submit" class="m-3 btn btn-outline-primary" value="Salvar">
                </div>

        </div>
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
