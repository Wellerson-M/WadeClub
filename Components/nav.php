

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
        xintegrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

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

        /* --- CAROUSEL --- */
        .carousel-container {
            margin-top: 60px; 
            margin-bottom: 50px;
            border-radius: 0 0 8px 8px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .carousel-item img {
            height: 520px;
            object-fit: cover;
            object-position: top center; 
        }
        @media (max-width: 768px) { .carousel-item img { height: 300px; } }

        /* --- CARD DE PRODUTO (Vertical / Portrait) --- */
        .card-product {
            border: none;
            background: #fff;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            /* AUMENTADO AQUI PARA 550PX PARA FICAR RETANGULAR */
            height: 550px; 
        }
        
        .card-product:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .img-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .img-main, .img-hover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.4s ease-in-out;
        }

        .img-hover {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            z-index: 1;
        }

        .card-product:hover .img-hover { opacity: 1; }

        .overlay-gradient {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60%; /* Gradiente sobe até 60% da foto */
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 60%, transparent 100%);
            z-index: 2;
            pointer-events: none;
        }

        .card-info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 25px;
            z-index: 3;
            color: white;
            text-align: left;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
            font-family: 'Oswald', sans-serif;
            letter-spacing: 1px;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        .installments {
            font-size: 0.8rem;
            opacity: 0.9;
            font-weight: 300;
            margin-top: 4px;
            color: #ddd;
        }

        .badge-frete {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: var(--wade-dark);
            color: #fff;
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 3;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        }

        .btn-fav {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: 0.2s;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .btn-fav:hover {
            background: #fff;
            color: #dc3545;
            transform: scale(1.1);
        }

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

    </style>
</head>

    
    
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
    <div class="nav-secondary" id="navSecundaria" style="margin-bottom: 80px;">
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
                    <input class="form-control bg-dark text-white border-secondary" type="search" placeholder="Buscar..." onchange="location.href='index.php?search='+this.value">
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
