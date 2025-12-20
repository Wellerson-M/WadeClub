<?php
session_start();
include "conexao.php";
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <title>Wade Club | Streetwear</title>

    <style>
        :root {
            --wade-dark: #212529;
            --wade-bg: #ececec;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--wade-bg); 
            color: var(--wade-dark);
            padding-top: 86px;
        }

        h1, h2, h3, h4, h5, .navbar-brand, .nav-link-street {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- NAVBAR PRINCIPAL --- */
        .navbar-main {
            background-color: var(--wade-dark);
            min-height: 86px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            padding: 10px 0;
        }
        
        .navbar-brand img {
            max-height: 70px;
            width: auto;
            transition: transform 0.3s;
        }
        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        @media (max-width: 991px) {
            .navbar-brand img { max-height: 50px; }
            body { padding-top: 76px; }
            .navbar-main { min-height: 76px; }
        }

        /* Barra de Pesquisa */
        .search-container {
            position: relative;
            width: 100%;
            max-width: 100%;
        }
        .search-input {
            border-radius: 50px;
            padding-left: 25px;
            padding-right: 60px;
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            height: 50px;
            font-size: 1.05rem;
            width: 100%;
        }
        .search-input:focus {
            background-color: #fff;
            color: #333;
            box-shadow: 0 0 20px rgba(255,255,255,0.2);
            border-color: #fff;
        }
        .search-input::placeholder { color: rgba(255,255,255,0.7); }
        .search-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            padding: 8px;
            border-radius: 50%;
            transition: 0.3s;
        }
        .search-input:focus ~ .search-btn { color: var(--wade-dark); }

        /* --- NAVBAR SECUNDÁRIO --- */
        .nav-secondary {
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            position: fixed;
            top: 86px;
            width: 100%;
            z-index: 1020;
            transition: top 0.3s;
            overflow-x: auto;
            white-space: nowrap;
        }
        
        @media (max-width: 991px) { .nav-secondary { top: 76px; } }
        
        .nav-link-street {
            color: #555;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 15px 25px;
            position: relative;
            display: inline-block;
        }
        .nav-link-street:hover { color: #000; }
        .nav-link-street::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--wade-dark);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link-street:hover::after { width: 60%; }

        /* Footer */
        footer {
            background-color: #1a1a1a;
            color: #999;
            margin-top: 80px;
            padding-top: 60px;
            padding-bottom: 40px;
        }
        
        /* Offcanvas */
        .offcanvas-street {
            background-color: var(--wade-dark);
            color: white;
        }
        .offcanvas-header { border-bottom: 1px solid #333; }
        .menu-link {
            color: #adb5bd;
            font-size: 1.1rem;
            padding: 12px 0;
            border-bottom: 1px solid #333;
            display: block;
            text-decoration: none;
            transition: 0.3s;
            font-family: 'Oswald', sans-serif;
        }
        .menu-link:hover { color: #fff; padding-left: 10px; }

        .zoom img {
          max-width: 100%;
          -moz-transition: all 0.5s;
          -webkit-transition: all 0.5s;
          transition: all 0.5s;
        }
        .zoom:hover img {
          -moz-transform: scale(1.2);
          -webkit-transform: scale(1.2);
          transform: scale(1.2);
        }

    </style>

    <?php 
        $id_produto = $_GET["id_produto"];
    ?>

</head>

<body>

    <!-- NAVBAR PRINCIPAL -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-main fixed-top" id="navbarMain">
        <div class="container px-3 px-lg-4">
            
            <div class="d-flex align-items-center w-100 justify-content-between">
                
                <!-- Logo -->
                <a class="navbar-brand me-3 me-lg-4" href="index.php">
                    <img src="img/logo.png" alt="Wade Club">
                </a>

                <!-- Barra de Pesquisa (Desktop e Tablet) -->
                <div class="d-none d-md-flex flex-grow-1 mx-3 mx-lg-5 justify-content-center">
                    <div class="search-container">
                        <input class="search-input" type="search" placeholder="O que você procura hoje?" id="pesquisar">
                        <button class="search-btn" type="button" onclick="searchData()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Ícones Direita -->
                <div class="d-flex align-items-center gap-3 gap-lg-4">
                    
                    <!-- Login/Olá -->
                    <div class="d-none d-lg-block text-white">
                        <?php if(!isset($_SESSION['id']) && !isset($_SESSION['nome'])){ ?>
                            <a href="login.html" class="text-white text-decoration-none fw-bold small">ENTRAR</a>
                        <?php } else { ?>
                            <a href="informacoes_usuario.php" class="text-white text-decoration-none fw-bold small">
                                OLÁ, <?php echo strtoupper(explode(' ', $_SESSION['nome'])[0]); ?>
                            </a>
                        <?php } ?>
                    </div>

                    <!-- Carrinho -->
                    <a href="carrinho.php" class="position-relative text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                    </a>

                    <!-- Botão Menu Lateral -->
                    <a class="text-white cursor-pointer" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <!-- NAVBAR SECUNDÁRIO -->
    <div class="nav-secondary" id="navSecundaria">
        <ul class="nav justify-content-center flex-nowrap" style="min-width: 100%;">
            <li class="nav-item"><a class="nav-link nav-link-street" href="index.php">HOME</a></li>
            <li class="nav-item"><a class="nav-link nav-link-street" href="categoria.php?cat=camiseta">CAMISETAS</a></li>
            <li class="nav-item"><a class="nav-link nav-link-street" href="categoria.php?cat=calcas">CALÇAS</a></li>
            <li class="nav-item"><a class="nav-link nav-link-street" href="categoria.php?cat=moletom">MOLETOM</a></li>
        </ul>
    </div>

    <!-- OFFCANVAS (Menu Lateral) -->
    <div class="offcanvas offcanvas-end offcanvas-street" tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-header border-bottom border-secondary">
            <h5 class="offcanvas-title font-monospace text-uppercase">Menu Wade</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between">
            <div>
                <a href="index.php" class="menu-link">INÍCIO</a>
                <a href="carrinho.php" class="menu-link">CARRINHO</a>
                <a href="index.php#destaques" class="menu-link text-white fw-bold">PROMOÇÕES 🔥</a>
                <a href="minhas_compras.php" class="menu-link">MINHAS COMPRAS</a>
                <a href="favoritos.php" class="menu-link">LISTA DE DESEJOS</a>
                <a href="informacoes_usuario.php" class="menu-link">MEUS DADOS</a>

                <?php if(isset($_SESSION['adm_usuario']) && $_SESSION['adm_usuario'] == 1) { ?>
                    <a href="tela_adm.php" class="menu-link text-warning mt-3">PAINEL ADMIN</a>
                <?php } ?>
                
                <div class="d-block d-md-none mt-4">
                    <input class="form-control bg-dark text-white border-secondary" type="search" placeholder="Buscar..." onchange="location.href='categoria.php?search='+this.value">
                </div>
            </div>

            <div class="mt-4">
                <?php if(isset($_SESSION['id']) || isset($_SESSION['nome'])){ ?>
                    <a href="sair.php" class="btn btn-outline-danger w-100 py-2 text-uppercase fw-bold">Sair</a>
                <?php } else { ?>
                    <a href="cadastro.html" class="btn btn-light w-100 py-2 text-uppercase fw-bold text-dark">Criar Conta</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <main>
        <nav aria-label="breadcrumb">
            <ol class="mx-5 mt-2 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="categoria.php">Categoria</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produto</li>
            </ol>
        </nav>

        <div class="row container-fluid m-1 px-4">
            <div class="position-relative">
                <form method="POST" action="inserir_carrinho.php">
                
                    <div>
                        <input class="invisible" type="text" name="id_produto" id="id_produto" value="<?php echo $id_produto ?>" readonly>
                    <?php 
                        include("listar_um_produto.php");
                        
                        if (!empty($listaItens)) {
                            foreach($listaItens as $linha) { 
                                echo '<div class="zoom"> <p><img height="100%" class="mx-5 my-2 img-thumbnail rounded float-start col-4" width="100%" src="'.$linha['imagem'].'"></p></div>';
                            }
                        }
                        ?>
                       <?php 
                            include("listar_um_produto.php");

                                if (!empty($listaItens)) {
                                    foreach($listaItens as $linha) { 
                            
                                        echo "<h3>".$linha['nome_produto']."</h3>";
                                        if (($linha['categoria'] !=2)  AND ($linha['categoria'] !=3)) {
                                            echo "";
                                        }
                                        if (($linha['categoria'] !=1)  AND ($linha['categoria'] !=3)) {
                                            echo "";
                                        }
                                        if (($linha['categoria'] !=1)  AND ($linha['categoria'] !=2)) {
                                            echo "";
                                        }

                                    }
                                }
                        ?> 

                        <?php   
                            include("listar_um_produto.php");

                                if (!empty($listaItens)) {
                                    foreach($listaItens as $linha) { ?>
                           
                           <h4 class=" text-danger"><?php echo "R$".$linha['preco'].",00";?></h4>
                           <span style="font-size: medium;">  Ou em 2x de</span>  
                           <p class="text-danger pb-1"><?php echo "R$".($linha['preco']/2)." sem juros";?> </p>
                                    <?php
                                    }
                                }
                        ?> 
                        <div class="d-flex " style="max-width: 300px">
                            <div class="form-outline col-2">
                                <h6 class="form-label">Quantidade:</h6>
                                
                                <input id="quantidade" name="quantidade" min="1" value="1" type="number" class="form-control" />
                            </div> 
                        </div>


                        <h6 class="pt-2 position-relative  ">Tamanho: <input type="text" id="tamanho" name="tamanho" class="text-muted" style="border:none; outline:0;" readonly></h6>
                        <div class=" pagination position-relative ">
                            <div class="row position-absolute top-100 ">

                                <button type="button" class="col btn btn-primary page-link" value="M" id="buttonTamanho1" onclick="carInput1()">M</button>
                                <button type="button" class="col btn btn-primary page-link" value="G" id="buttonTamanho2" onclick="carInput2()">G</button>
                                <button type="button" class="col btn btn-primary page-link" value="GG" id="buttonTamanho3" onclick="carInput3()">GG</button>
                                <button type="button" class="col btn btn-primary page-link" value="XGG" id="buttonTamanho4" onclick="carInput4()">XGG</button>
                            </div> 
                    </div>

                    <div class="invisible py-4"></div>
                    <div>
                    <button type="button" class="my-3 btn btn-outline-success col-6">Finalizar compra</button>
                   

                    <button type="submit" class=" btn btn-outline-info col-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                        <path
                            d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                    </svg> Adicionar ao carrinho</button>


                    <a href="inserir_favoritos.php?id_produto=<?php echo $linha['id_produto'];?>">
                        <button type="button" action="inserir_carrinho.php" class=" btn btn-outline-info col-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>Adicionar aos favoritos</button>
                    </a>
                 </div>
                    </div>

                   



                
                </form>
            </div>


        </div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    
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
                // Sobe a navbar secundária se a principal mudar de tamanho no mobile
                const headerHeight = document.getElementById('navbarMain').offsetHeight;
                navSecundaria.style.top = headerHeight + 'px';
            }
            lastScrollTop = scrollTop;
        });

        // Tamanho seletor
        function carInput1(){
            document.getElementById("tamanho").value = document.getElementById("buttonTamanho1").value;
        }
        function carInput2(){
            document.getElementById("tamanho").value = document.getElementById("buttonTamanho2").value;
        }
        function carInput3(){
            document.getElementById("tamanho").value = document.getElementById("buttonTamanho3").value;
        }
        function carInput4(){
            document.getElementById("tamanho").value = document.getElementById("buttonTamanho4").value;
        }
        function carInput5(){
            document.getElementById("tamanho").value = document.getElementById("buttonTamanho5").value;
        }
        function carInput6(){
            document.getElementById("tamanho").value = document.getElementById("buttonTamanho6").value;
        }
        function carInput7(){
            document.getElementById("tamanho").value = document.getElementById("buttonTamanho7").value;
        }       
    </script>

</body>

</html>
