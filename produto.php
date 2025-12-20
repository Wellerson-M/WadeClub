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

        /* --- CAROUSEL DE PRODUTOS --- */
        .product-carousel {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .carousel-container {
            max-height: 500px;
        }

        .carousel-item img {
            height: 600px;
            object-fit: cover;
        }

        .carousel-inner {
            border-radius: 12px;
        }

        .carousel-control-prev, .carousel-control-next {
            background: rgba(0,0,0,0.3);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            background: rgba(0,0,0,0.6);
        }

        /* --- DETALHES DO PRODUTO --- */
        .product-details {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .product-title-detail {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-price-detail {
            font-size: 1.8rem;
            font-weight: 600;
            color: #dc3545;
            margin-bottom: 10px;
        }

        .installments-detail {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 25px;
        }

        .size-selector {
            margin-bottom: 25px;
        }

        .size-label {
            font-weight: 700;
            font-family: 'Oswald', sans-serif;
            margin-bottom: 10px;
            display: block;
        }

        .size-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .size-btn {
            padding: 10px 20px;
            border: 2px solid #ddd;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-family: 'Oswald', sans-serif;
        }

        .size-btn:hover {
            border-color: #212529;
        }

        .size-btn.active {
            background: #212529;
            color: white;
            border-color: #212529;
        }

        .quantity-selector {
            margin-bottom: 25px;
        }

        .quantity-label {
            font-weight: 700;
            font-family: 'Oswald', sans-serif;
            margin-bottom: 10px;
            display: block;
        }

        .quantity-input {
            max-width: 150px;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-checkout {
            padding: 15px;
            background: #212529;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-checkout:hover {
            background: #0d0d0d;
            transform: translateY(-2px);
        }

        .btn-add-cart {
            padding: 15px;
            background: white;
            color: #212529;
            border: 2px solid #212529;
            border-radius: 8px;
            font-weight: 700;
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-add-cart:hover {
            background: #212529;
            color: white;
        }

        .btn-favorite {
            padding: 15px;
            background: white;
            color: #dc3545;
            border: 2px solid #dc3545;
            border-radius: 8px;
            font-weight: 700;
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-favorite:hover {
            background: #dc3545;
            color: white;
        }

        @media (max-width: 991px) {
            .action-buttons {
                grid-template-columns: 1fr;
            }

            .carousel-item img {
                height: 350px;
            }

            .product-title-detail {
                font-size: 1.5rem;
            }

            .product-price-detail {
                font-size: 1.3rem;
            }
        }

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

        <div class="container py-4">
            <?php 
                include("listar_um_produto.php");
                
                if (!empty($listaItens)) {
                    foreach($listaItens as $linha) {
                        $preco = number_format($linha['preco'], 2, ',', '.');
                        $parcelado = number_format($linha['preco'] / 2, 2, ',', '.');
            ?>
            <form method="POST" action="inserir_carrinho.php">
                <input type="hidden" name="id_produto" value="<?php echo $linha['id_produto']; ?>">
                
                <div class="row g-4">
                    <!-- CAROUSEL DE IMAGENS -->
                    <div class="col-lg-6">
                        <div class="product-carousel">
                            <div id="carouselProduto" class="carousel slide carousel-container" data-bs-ride="carousel">
                                <?php
                                // Buscar todas as imagens do produto
                                $cmd_imagens = $pdo->prepare("SELECT imagem FROM imagens_produto WHERE id_produto = :id ORDER BY id_img ASC");
                                $cmd_imagens->bindValue(":id", $linha['id_produto']);
                                $cmd_imagens->execute();
                                $todasImagens = $cmd_imagens->fetchAll(PDO::FETCH_ASSOC);
                                
                                // Se não houver imagens adicionais, usar a imagem principal
                                if (empty($todasImagens)) {
                                    $todasImagens = [['imagem' => $linha['imagem']]];
                                } else {
                                    // Adicionar imagem principal no início se não estiver lá
                                    array_unshift($todasImagens, ['imagem' => $linha['imagem']]);
                                }
                                
                                $totalImagens = count($todasImagens);
                                ?>
                                
                                <?php if ($totalImagens > 1): ?>
                                <div class="carousel-indicators">
                                    <?php for($i = 0; $i < $totalImagens; $i++): ?>
                                        <button type="button" data-bs-target="#carouselProduto" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo ($i === 0) ? 'active' : ''; ?>"></button>
                                    <?php endfor; ?>
                                </div>
                                <?php endif; ?>
                                
                                <div class="carousel-inner">
                                    <?php foreach($todasImagens as $index => $imgData): ?>
                                    <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>" data-bs-interval="5000">
                                        <img src="<?php echo $imgData['imagem']; ?>" class="d-block w-100" alt="<?php echo $linha['nome_produto']; ?> - Imagem <?php echo ($index + 1); ?>">
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <?php if ($totalImagens > 1): ?>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduto" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselProduto" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- DETALHES DO PRODUTO -->
                    <div class="col-lg-6">
                        <div class="product-details">
                            <h1 class="product-title-detail"><?php echo strtoupper($linha['nome_produto']); ?></h1>
                            
                            <div class="product-price-detail">
                                R$ <?php echo $preco; ?>
                            </div>
                            
                            <div class="installments-detail">
                                ou 2x de R$ <?php echo $parcelado; ?> sem juros
                            </div>
                            
                            <hr>
                            
                            <!-- SELETOR DE TAMANHO -->
                            <div class="size-selector">
                                <label class="size-label">Escolha o tamanho:</label>
                                <div class="size-buttons">
                                    <button type="button" class="size-btn" onclick="selecionarTamanho(this, 'M')">M</button>
                                    <button type="button" class="size-btn" onclick="selecionarTamanho(this, 'G')">G</button>
                                    <button type="button" class="size-btn" onclick="selecionarTamanho(this, 'GG')">GG</button>
                                    <button type="button" class="size-btn" onclick="selecionarTamanho(this, 'XGG')">XGG</button>
                                </div>
                                <input type="hidden" id="tamanho" name="tamanho" value="">
                            </div>
                            
                            <!-- QUANTIDADE -->
                            <div class="quantity-selector">
                                <label class="quantity-label">Quantidade:</label>
                                <input type="number" id="quantidade" name="quantidade" min="1" value="1" class="form-control quantity-input">
                            </div>
                            
                            <!-- BOTÕES DE AÇÃO -->
                            <div class="action-buttons">
                                <button type="submit" class="btn-add-cart">
                                    🛒 Adicionar ao Carrinho
                                </button>
                                <a href="inserir_favoritos.php?id_produto=<?php echo $linha['id_produto']; ?>" class="btn-favorite" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                    ❤️ Adicionar aos Favoritos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                    }
                } else {
                    echo '<div class="alert alert-warning">Produto não encontrado.</div>';
                }
            ?>
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

        // Seletor de Tamanho
        function selecionarTamanho(button, tamanho) {
            // Remove a classe active de todos os botões
            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Adiciona a classe active ao botão clicado
            button.classList.add('active');
            
            // Define o valor do input oculto
            document.getElementById('tamanho').value = tamanho;
        }

        // Validação antes de enviar o formulário
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const tamanho = document.getElementById('tamanho').value;
                    if (!tamanho) {
                        e.preventDefault();
                        alert('Por favor, selecione um tamanho antes de continuar!');
                        return false;
                    }
                });
            }
        });
    </script>

</body>

</html>
