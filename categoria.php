  <?php
session_start();
include("conexao.php");
?>
<!DOCTYPE html>
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

    <title>Wade Club | Categoria</title>

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

        /* --- CARD DE PRODUTO --- */
        .card-product {
            border: none;
            background: #fff;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 320px;
        }

        .card-product:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .img-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .img-main {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay-gradient {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.3) 80%, transparent 100%);
            z-index: 2;
            pointer-events: none;
        }

        .card-info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px 20px;
            z-index: 3;
            color: white;
            text-align: left;
        }

        .product-title {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
            font-family: 'Oswald', sans-serif;
            letter-spacing: 0.5px;
            line-height: 1.1;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        .installments {
            font-size: 0.7rem;
            opacity: 0.85;
            font-weight: 300;
            color: #ddd;
        }

        .badge-frete {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: var(--wade-dark);
            color: #fff;
            padding: 5px 10px;
            font-size: 0.7rem;
            font-weight: 600;
            z-index: 4;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-fav {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(3px);
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            transition: all 0.3s ease;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.3);
            font-size: 1.2rem;
            padding: 0;
            cursor: pointer;
        }
            z-index: 10;
            transition: 0.2s;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .btn-fav:hover {
            background: #ff6b6b;
            transform: scale(1.15);
            border-color: #ff6b6b;
        }

        /* --- LAYOUT PRINCIPAL --- */
        main {
            padding-top: 30px;
            padding-bottom: 60px;
        }

        /* --- FOOTER --- */
        footer {
            background-color: #1a1a1a;
            color: #999;
            margin-top: 80px;
            padding-top: 60px;
            padding-bottom: 40px;
        }

        footer h5 {
            color: white;
            font-family: 'Oswald', sans-serif;
        }

        footer a {
            transition: 0.3s;
        }

        footer a:hover {
            color: #fff !important;
        }

        /* --- OFFCANVAS --- */
        .offcanvas-street {
            background-color: var(--wade-dark);
            color: white;
        }

        .offcanvas-header {
            border-bottom: 1px solid #333;
        }

        .offcanvas-title {
            font-family: 'Oswald', sans-serif;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .menu-link {
            color: #adb5bd;
            font-size: 1rem;
            padding: 12px 0;
            border-bottom: 1px solid #333;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .menu-link:hover {
            color: #fff;
            padding-left: 10px;
        }

        /* --- RESPONSIVO --- */
        @media (max-width: 991px) {
            .card-product {
                height: 280px;
            }

            main {
                padding-top: 15px;
                padding-bottom: 40px;
            }
        }

        @media (max-width: 575px) {
            .card-product {
                height: 250px;
            }

            .product-title {
                font-size: 0.85rem;
            }

            .product-price {
                font-size: 0.95rem;
            }

            .installments {
                font-size: 0.65rem;
            }

            .badge-frete {
                padding: 3px 8px;
                font-size: 0.6rem;
                top: 8px;
                left: 8px;
            }

            .btn-fav {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
                top: 8px;
                right: 8px;
            }
        }

    </style>
</head>

<body>

    <?php include "Components/nav.php"; ?>

<!-- CONTEÚDO PRINCIPAL -->
    <main>
        <div class="container">

            <!-- LAYOUT: FILTROS À ESQUERDA, PRODUTOS À DIREITA -->
            <div class="row">
                <!-- Sidebar de filtros -->
                <aside class="col-lg-3 mb-4 mb-lg-0">
                    <div class="bg-white p-4 rounded-3 shadow-sm sticky-top" style="top: 110px;">
                        <h5 class="text-uppercase mb-4" style="font-family: 'Oswald', sans-serif; letter-spacing: 1px;">Filtrar produtos</h5>

                        <form method="GET" action="categoria.php" class="row g-3">
                            <!-- Filtro de Categoria -->
                            <div class="col-12">
                                <label for="filterCategoria" class="form-label fw-bold">Categoria</label>
                                <select class="form-select form-select-lg" id="filterCategoria" name="cat">
                                    <option value="">Todas as Categorias</option>
                                    <?php
                                    $categorias = $pdo->query("SELECT DISTINCT categoria FROM produtos ORDER BY categoria ASC");
                                    while ($cat = $categorias->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = (isset($_GET['cat']) && $_GET['cat'] == $cat['categoria']) ? 'selected' : '';
                                        echo "<option value='{$cat['categoria']}' $selected>" . ucfirst($cat['categoria']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Filtro de Marca -->
                            <div class="col-12">
                                <label for="filterMarca" class="form-label fw-bold">Marca</label>
                                <select class="form-select form-select-lg" id="filterMarca" name="marca">
                                    <option value="">Todas as Marcas</option>
                                    <?php
                                    $marcas = $pdo->query("SELECT DISTINCT marca FROM produtos ORDER BY marca ASC");
                                    while ($marca_row = $marcas->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = (isset($_GET['marca']) && $_GET['marca'] == $marca_row['marca']) ? 'selected' : '';
                                        echo "<option value='{$marca_row['marca']}' $selected>" . ucfirst($marca_row['marca']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Botões -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-dark w-100 py-2 text-uppercase fw-bold" style="font-family: 'Oswald', sans-serif; letter-spacing: 0.5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel me-2" viewBox="0 0 16 16">
                                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V8.692L1.128 3.334A.5.5 0 0 1 1.5 3V1.5Z"/>
                                    </svg> Aplicar filtro
                                </button>
                                <?php if(isset($_GET['cat']) || isset($_GET['marca']) || isset($_GET['search'])): ?>
                                    <a href="categoria.php" class="btn btn-outline-secondary w-100 py-2 text-uppercase fw-bold mt-2" style="font-family: 'Oswald', sans-serif; letter-spacing: 0.5px;">Limpar filtros</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </aside>

                <!-- Área de produtos -->
                <section class="col-lg-9">

            <!-- SEÇÃO DE PRODUTOS -->
            <div class="row g-4">
                <?php
                // Barra de Pesquisa e Filtros
                $query = "SELECT * FROM produtos WHERE 1=1";
                $params = [];
                
                // Filtro de Categoria
                if(!empty($_GET['cat'])) {
                    $query .= " AND categoria = ?";
                    $params[] = $_GET['cat'];
                }
                
                // Filtro de Marca
                if(!empty($_GET['marca'])) {
                    $query .= " AND marca = ?";
                    $params[] = $_GET['marca'];
                }
                
                // Pesquisa por Nome
                if(!empty($_GET['search'])) {
                    $query .= " AND (nome_produto LIKE ? OR categoria LIKE ?)";
                    $search_term = "%{$_GET['search']}%";
                    $params[] = $search_term;
                    $params[] = $search_term;
                }
                
                // Se nenhum filtro, buscar todos
                if(empty($_GET['cat']) && empty($_GET['marca']) && empty($_GET['search'])) {
                    include("listar_produtos.php");
                } else {
                    $comando = $pdo->prepare($query);
                    $comando->execute($params);
                    $listaItens = $comando->fetchAll();
                }
                
                if (!empty($listaItens)) {
                    foreach($listaItens as $linha) { 
            ?>
        
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="produto.php?id_produto=<?php echo $linha['id_produto'];?>" class="text-decoration-none" style="color: inherit;">
                        <div class="card-product">
                            <div class="img-wrapper">
                                <img src="<?php echo $linha['imagem'];?>" alt="<?php echo $linha['nome_produto'];?>" class="img-main">
                            </div>

                            <div class="overlay-gradient"></div>

                            <div class="card-info-overlay">
                                <div class="product-title"><?php echo strtoupper($linha['nome_produto']);?></div>
                                <div class="product-price">R$ <?php echo number_format($linha['preco'], 2, ',', '.');?></div>
                                <div class="installments">até 12x de R$ <?php echo number_format($linha['preco'] / 12, 2, ',', '.');?></div>
                            </div>

                            <span class="badge-frete">FRETE GRÁTIS</span>

                            <button type="button" class="btn-fav" onclick="event.preventDefault(); event.stopPropagation(); location.href='inserir_favoritos.php?id_produto=<?php echo $linha['id_produto'];?>';" title="Adicionar aos favoritos">
                                ❤️
                            </button>
                        </div>
                    </a>
                </div>
                <?php
                    }
                } else {
                    echo '<div class="col-12 text-center py-5"><p class="text-muted fs-5">Nenhum produto encontrado.</p></div>';
                }
                ?>
            </div>
                </section>
            </div>

        </div>
    </main>

    <?php include "Components/footer.php"; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Busca no Desktop
        const pesquisar = document.getElementById('pesquisar');
        if (pesquisar) {
            pesquisar.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    searchData();
                }
            });
        }

        function searchData() {
            const valor = document.getElementById('pesquisar')?.value || '';
            if (valor.trim()) {
                window.location = 'categoria.php?search=' + encodeURIComponent(valor);
            }
        }

        // Busca no Mobile
        const mobileSearch = document.getElementById('mobileSearch');
        if (mobileSearch) {
            mobileSearch.addEventListener("change", function() {
                if (this.value.trim()) {
                    window.location = 'categoria.php?search=' + encodeURIComponent(this.value);
                }
            });
        }

        // Navbar Sticky Inteligente
        let lastScrollTop = 0;
        const navbarMain = document.getElementById('navbarMain');
        const navSecundaria = document.getElementById('navSecundaria');

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop && scrollTop > 100) {
                navSecundaria.style.top = '-60px';
            } else {
                const headerHeight = navbarMain.offsetHeight;
                navSecundaria.style.top = headerHeight + 'px';
            }
            lastScrollTop = scrollTop;
        });
    </script>
    
</body>
</html>
