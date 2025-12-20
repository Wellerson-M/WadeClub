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

        /* --- GALERIA DE PRODUTO (imagem grande + miniaturas) --- */
        .product-gallery {
            display: flex;
            gap: 16px;
        }

        .thumbs {
            width: 88px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .thumb {
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            padding: 4px;
            background: #fff;
            cursor: pointer;
            transition: border-color 0.2s ease, transform 0.2s ease;
        }
        .thumb:hover { border-color: #bbb; transform: translateY(-1px); }
        .thumb.active { border-color: #212529; }

        .thumb img {
            width: 100%;
            height: 72px;
            object-fit: cover;
            border-radius: 6px;
        }

        .main-image-wrapper {
            flex: 1;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 420px;
        }

        .main-image {
            max-width: 100%;
            max-height: 520px;
            object-fit: contain;
            transition: transform 0.25s ease;
        }
        .main-image-wrapper:hover .main-image { transform: scale(1.05); }

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

            .thumbs { width: 72px; }
            .thumb img { height: 60px; }
            .main-image { max-height: 360px; }

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

    <?php include "Components/nav.php"; ?>

<main>
        <nav aria-label="breadcrumb mt-5">
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
                    <!-- GALERIA DE IMAGENS -->
                    <div class="col-lg-6">
                        <?php
                            // Buscar todas as imagens do produto
                            $cmd_imagens = $pdo->prepare("SELECT imagem FROM imagens_produto WHERE id_produto = :id ORDER BY id_img ASC");
                            $cmd_imagens->bindValue(":id", $linha['id_produto']);
                            $cmd_imagens->execute();
                            $todasImagens = $cmd_imagens->fetchAll(PDO::FETCH_ASSOC);

                            // Garantir que haja pelo menos a imagem principal
                            if (empty($todasImagens)) {
                                $todasImagens = [['imagem' => $linha['imagem']]];
                            } else {
                                // Colocar a imagem principal primeiro
                                array_unshift($todasImagens, ['imagem' => $linha['imagem']]);
                            }
                        ?>

                        <div class="product-gallery">
                            <div class="thumbs">
                                <?php foreach($todasImagens as $index => $imgData): ?>
                                    <button type="button" class="thumb <?php echo ($index === 0) ? 'active' : ''; ?>" data-image="<?php echo $imgData['imagem']; ?>" aria-label="Miniatura <?php echo $index + 1; ?>">
                                        <img src="<?php echo $imgData['imagem']; ?>" alt="Miniatura <?php echo $index + 1; ?>">
                                    </button>
                                <?php endforeach; ?>
                            </div>

                            <div class="main-image-wrapper">
                                <img id="mainImage" class="main-image" src="<?php echo $todasImagens[0]['imagem']; ?>" alt="<?php echo htmlspecialchars($linha['nome_produto']); ?>">
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

    <?php include "Components/footer.php"; ?>

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
            // Troca de imagem principal ao clicar nas miniaturas
            const thumbs = document.querySelectorAll('.thumb');
            const mainImage = document.getElementById('mainImage');
            thumbs.forEach(btn => {
                btn.addEventListener('click', () => {
                    const src = btn.getAttribute('data-image');
                    if (src && mainImage) {
                        mainImage.src = src;
                        // atualiza estado ativo
                        thumbs.forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                    }
                });
            });
        });
    </script>

</body>

</html>
