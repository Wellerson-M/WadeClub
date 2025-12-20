<?php
session_start();
include("conexao.php");
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
 if(!isset($_SESSION['id']) and (!isset($_SESSION['nome']))){
   header("location:login.html");
 } 
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Custom CSS -->
  <style>
    :root {
      --wade-dark: #212529;
      --wade-bg: #ececec;
    }

    * {
      font-family: 'Inter', sans-serif;
    }

    h1, h2, h3, h4, h5, h6, .navbar-brand {
      font-family: 'Oswald', sans-serif;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    body {
      background-color: var(--wade-bg);
      color: #333;
    }

    /* NAVBAR PRINCIPAL */
    .navbar-main {
      background-color: var(--wade-dark) !important;
      height: 86px;
      display: flex;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-main .navbar-brand img {
      height: 60px;
      width: auto;
    }

    .navbar-main .search-container {
      display: flex;
      width: 100%;
      max-width: 400px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 25px;
      padding: 5px 15px;
      backdrop-filter: blur(10px);
    }

    .navbar-main .search-container input {
      background: transparent;
      border: none;
      color: white;
      width: 100%;
      font-size: 14px;
    }

    .navbar-main .search-container input::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .navbar-main .search-container button {
      background: none;
      border: none;
      color: white;
      cursor: pointer;
      padding: 0;
      display: flex;
      align-items: center;
    }

    /* NAVBAR SECUNDÁRIA */
    .nav-secondary {
      position: fixed;
      top: 86px;
      left: 0;
      right: 0;
      background-color: var(--wade-dark);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      z-index: 1020;
      height: 60px;
      display: flex;
      align-items: center;
      transition: top 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .nav-secondary .nav {
      width: 100%;
      margin: 0;
    }

    .nav-secondary .nav-link {
      color: #ccc !important;
      font-weight: 600;
      font-size: 12px;
      letter-spacing: 0.5px;
      transition: color 0.3s ease;
    }

    .nav-secondary .nav-link:hover,
    .nav-secondary .nav-link.active {
      color: #fff !important;
    }

    .nav-link-street {
      text-transform: uppercase;
      font-weight: 700;
      font-size: 11px;
    }

    /* OFFCANVAS STYLING */
    .offcanvas-street {
      background-color: var(--wade-dark);
      width: 280px !important;
    }

    .offcanvas-street .offcanvas-header {
      background-color: #1a1a1a;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .offcanvas-street .offcanvas-header h5 {
      color: white;
      font-family: 'Oswald', sans-serif;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .offcanvas-street .btn-close {
      filter: brightness(0) invert(1);
    }

    .offcanvas-street .offcanvas-body {
      padding: 0;
      border: none;
    }

    .offcanvas-street .offcanvas-body p {
      margin: 0;
      padding: 12px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .offcanvas-street .offcanvas-body p:last-child {
      border-bottom: none;
    }

    .offcanvas-street .offcanvas-body a {
      color: #aaa;
      font-size: 13px;
      transition: color 0.3s ease;
    }

    .offcanvas-street .offcanvas-body a:hover {
      color: #fff;
    }

    /* FOOTER */
    footer {
      background-color: #1a1a1a !important;
      color: #ccc;
      border-top: 2px solid var(--wade-dark);
      margin-top: 60px;
    }

    footer h5 {
      color: white;
      font-family: 'Oswald', sans-serif;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    footer a {
      color: #aaa;
      transition: color 0.3s ease;
    }

    footer a:hover {
      color: white;
    }

    footer p {
      font-size: 13px;
      line-height: 1.6;
    }

    footer .small {
      opacity: 0.8;
    }

    main {
      margin-top: 146px;
      min-height: calc(100vh - 320px);
      padding: 0;
    }

    /* Responsivo */
    @media (max-width: 768px) {
      .navbar-main {
        height: 70px;
      }

      .nav-secondary {
        top: 70px;
        height: 50px;
      }

      main {
        margin-top: 120px;
      }

      .offcanvas-street {
        width: 100% !important;
      }
    }
  </style>

  <title>Carrinho - Wade Club</title>

</head>

<body>

<!-- NAVBAR PRINCIPAL -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-main fixed-top" id="navbarMain">
    <div class="container px-3 px-lg-4">
        <!-- Logo -->
        <a class="navbar-brand me-3 me-lg-4" href="index.php">
            <img src="img/logo.png" alt="Wade Club">
        </a>
        
        <!-- Search Input -->
        <div class="search-container d-none d-md-flex flex-grow-1 mx-3 mx-lg-4">
            <input type="search" class="form-control" id="pesquisar" placeholder="O que você está procurando?" name="pesquisar">
            <button type="button" onclick="searchData()" style="padding: 0 10px;">🔍</button>
        </div>

        <!-- Menu Icons -->
        <div class="d-flex align-items-center gap-3">
            <!-- Login/User Menu -->
            <div class="d-none d-md-flex">
                <?php if(!isset($_SESSION['id']) and (!isset($_SESSION['nome']))){ ?>
                    <a href="login.html" class="text-white text-decoration-none" style="font-size: 12px; margin-right: 15px;">ENTRAR</a>
                    <a href="cadastro.html" class="text-white text-decoration-none" style="font-size: 12px;">CADASTRAR</a>
                <?php } else { ?>
                    <span class="text-white" style="font-size: 12px;">Bem-vindo, <?php echo $_SESSION['nome']; ?></span>
                <?php } ?>
            </div>

            <!-- Offcanvas Menu Toggle -->
            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 12.5A1.5 1.5 0 0 1 2.5 11h3A1.5 1.5 0 0 1 7 12.5v3A1.5 1.5 0 0 1 5.5 17h-3A1.5 1.5 0 0 1 1 15.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 11h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a1.5 1.5 0 0 1-1.5-1.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- NAVBAR SECUNDÁRIA -->
<div class="nav-secondary" id="navSecundaria">
    <ul class="nav justify-content-center flex-nowrap">
        <li class="nav-item"><a class="nav-link nav-link-street" href="index.php">HOME</a></li>
        <li class="nav-item"><a class="nav-link nav-link-street" href="categoria.php?cat=camiseta">CAMISETAS</a></li>
        <li class="nav-item"><a class="nav-link nav-link-street" href="categoria.php?cat=calca">CALÇAS</a></li>
        <li class="nav-item"><a class="nav-link nav-link-street" href="categoria.php?cat=moletom">MOLETOM</a></li>
    </ul>
</div>

<!-- OFFCANVAS MENU -->
<div class="offcanvas offcanvas-end offcanvas-street" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasMenuLabel">WADE CLUB</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php if (!isset($_SESSION['id']) or !isset($_SESSION['nome'])) { ?>
            <p><a href="login.html" class="text-reset text-decoration-none">ENTRAR</a></p>
            <p><a href="cadastro.html" class="text-reset text-decoration-none">CADASTRAR</a></p>
        <?php } else { ?>
            <p><a href="informacoes_usuario.php" class="text-reset text-decoration-none">BEM-VINDO, <?php echo strtoupper($_SESSION['nome']); ?></a></p>
            <?php if ($_SESSION['adm_usuario'] == 1) { ?>
                <p><a href="tela_adm.php" class="text-reset text-decoration-none">ADMINISTRADOR</a></p>
            <?php } ?>
        <?php } ?>
        <p><a href="index.php" class="text-reset text-decoration-none">HOME</a></p>
        <p><a href="categoria.php" class="text-reset text-decoration-none">CAMISETAS</a></p>
        <p><a href="categoria.php?cat=calca" class="text-reset text-decoration-none">CALÇAS</a></p>
        <p><a href="categoria.php?cat=moletom" class="text-reset text-decoration-none">MOLETOM</a></p>
        <p><a href="Carrinho.php" class="text-reset text-decoration-none">CARRINHO</a></p>
        <p><a href="favoritos.php" class="text-reset text-decoration-none">FAVORITOS</a></p>
        <p><a href="informacoes_endereco.php" class="text-reset text-decoration-none">ENDEREÇOS</a></p>
        <p><a href="informacoes_usuario.php" class="text-reset text-decoration-none">MEUS DADOS</a></p>
        <p><a href="sair.php" class="text-reset text-decoration-none">SAIR</a></p>
    </div>
</div>


    <main>
            <nav aria-label="breadcrumb">
                <ol class="mx-5 mt-2 breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carrinho</li>
                </ol>
            </nav>
                
            <section class="h-100 h-custom" >
                <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                    <div class="card card-registration card-registration-2 shadow border border-3" style="border-radius: 15px;">
                        <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                <h2 class="fw-bold mb-0 text-black">Carrinho de compras</h2>
                                </div>
                                <?php 
                                include("listar_carrinho.php");

                                if (!empty($listaItens)) {
                                    foreach($listaItens as $linha) { 
                                    
                            ?>
                                <hr class="my-4">

                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                <img height="100%" width="100%"  class="" src="<?php echo $linha['imagem'];?>">
                                
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <h5 class="text-black mb-0"><?php echo $linha['nome_produto'];?></h5>
                                    <input value="<?php echo $linha['quantidade'];?>" type="text"
                                    class="form-control form-control-sm" style="border:none;" readonly/>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <label class="text-muted">tamanho:
                                    <input value="<?php echo $linha['tamanho'];?>" type="text"
                                    class="form-control form-control-sm" style="border:none;" readonly/>
                                    </label>
                                
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h7 class="mb-0 text-muted">R$<?php echo $linha['preco'];?></h7>
                                    <h6 class="mb-0">R$<?php echo $linha['valor_final'];?></h6>
                                
                                    
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a href="excluir_produto.php?id_produto=<?php echo $linha['id_produto'];?>" >
                                    <button type="button" class="btn btn-outline" data-bs-toggle="tooltip" data-bs-placement="top"  title="Excluir produto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="danger bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                    </a>
                                </div>
                                </div>
                                <?php }} ?>



                                                                
                                    
                                <hr class="my-4">

                                <div class="pt-3">
                                <h6 class="mb-0"><a href="index.php" class="text-body"> <- Continuar comprando</a></h6>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 border" style="border-color:#808080; background-color:#DCDCDC;">
                            <div class="p-5">
                                <h3 class="fw-bold mb-5 mt-2 pt-1">Resumo</h3>
                                <?php if(!empty($linha['id_usuario'] = $_SESSION['id_usuario'])){ ?>
                                <hr class="my-4">

                                <div class="d-flex justify-content-between mb-4">
                                <h5 class="text-muted">Produtos:</h5>
                                <h5 class="text-muted">R$
                                    <?php 
                                    $id_usuario = $linha['id_usuario'];
                                    $sql = $pdo->prepare("SELECT SUM(valor_final) as total FROM carrinho WHERE id_usuario = $id_usuario");
                                        $sql->execute();

                                        $value = $sql->fetchObject();
                                        echo $value->total;       
                                    ?>
                                </h5>
                                </div>
                                <div class="d-flex justify-content-between mb-4 pt-3">
                                <h5 class="text-muted mb-3">Frete:</h5>
                                <h5 class="text-muted">Grátis</h5>
                                </div>
                                <hr class="my-4">
                            <h5>
                                <li
                                class=" mb-3 list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                <p class="text-uppercase mb-0"> Valor total</p>
                                    
                                <p class="text-uppercase mb-0" style="font-size:medium;"> (incluindo frete)</p>
                                    
                                </div>
                                <span>R$<?php echo $value->total; ?></span>
                                </li>
                                </h5>

                                <button type="button" class="mt-3 btn btn-secondary btn-block btn-lg"
                                data-mdb-ripple-color="dark">Finalizar pedido</button>
                                <?php }else{ echo "Não há itens no seu carrinho";} ?>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </section>

    </main>

    <!-- FOOTER -->
    <footer class="pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">WADE CLUB</h5>
                    <p class="small">Moda urbana com autenticidade. Peças exclusivas para quem vive o streetwear.</p>
                </div>
                <!-- Centralizado -->
                <div class="col-md-4 mb-4 text-center">
                    <h5 class="text-white mb-3">INSTITUCIONAL</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Quem Somos</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Política de Privacidade</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Trocas e Devoluções</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4 text-md-end">
                    <h5 class="text-white mb-3">FALE CONOSCO</h5>
                    <p class="small mb-0 text-muted">suporte@wadeclub.com.br</p>
                    <p class="small text-muted">&copy; 2025 Wade Club. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    
    <script>
        var search = document.getElementById('pesquisar');
        search.addEventListener("keydown", function(event){
            if (event.key === "Enter") {
                searchData();
            }
        });
        function searchData() {
            window.location = 'categoria.php?search='+search.value;
        }

        // Lógica do Navbar Sticky Inteligente
        let lastScrollTop = 0;
        const navbarMain = document.getElementById('navbarMain');
        const navSecundaria = document.getElementById('navSecundaria');
        
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                navSecundaria.style.top = '-60px'; 
            } else {
                const headerHeight = document.getElementById('navbarMain').offsetHeight;
                navSecundaria.style.top = headerHeight + 'px';
            }
            lastScrollTop = scrollTop;
        });
    </script>

</body>

</html>
