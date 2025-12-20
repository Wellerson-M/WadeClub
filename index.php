<?php
session_start();
include "conexao.php";
?>
<body>

    <?php 
    include "components/nav.php";
    ?>

    <!-- BANNERS -->
    <div class="container px-0 carousel-container">
        <div id="carouselMain" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="img/slide2.jpg" class="d-block w-100" alt="Coleção Nova">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="img/slide3.jpg" class="d-block w-100" alt="Promoção">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="img/slide4.jpg" class="d-block w-100" alt="Lifestyle">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="pb-5" id="destaques">
        <div class="container">
            
            <div class="d-flex justify-content-between align-items-center mb-4 pt-4 border-bottom pb-2">
                <h2 class="fw-bold m-0" style="font-size: 1.5rem;">DESTAQUES</h2>
                <a href="categoria.php" class="text-decoration-none text-muted small fw-bold">VER TUDO</a>
            </div>

            <div class="row g-4">
                <?php
                $sql = "SELECT * FROM produtos";
                if (!empty($_GET["search"])) {
                    $data = $_GET["search"];
                    $sql .= " WHERE nome_produto LIKE '%$data%' OR categoria LIKE '%$data%'";
                }
                
                $comando = $pdo->prepare($sql);
                $comando->execute();

                if ($comando->rowCount() > 0) {
                    while ($linha = $comando->fetch(PDO::FETCH_ASSOC)) {
                        $id_prod = $linha['id_produto'];
                        
                        $cmd_hover = $pdo->prepare("SELECT imagem FROM imagens_produto WHERE id_produto = :id LIMIT 1 OFFSET 1");
                        $cmd_hover->bindValue(":id", $id_prod);
                        $cmd_hover->execute();
                        $foto_hover = $cmd_hover->fetch(PDO::FETCH_ASSOC);
                        $img_secundaria = ($foto_hover) ? $foto_hover['imagem'] : '';
                ?>

                <!-- CARD DO PRODUTO (REESTILIZADO PARA RETRATO) -->
                <!-- Mudado para col-lg-4 (3 por linha) -->
                <div class="col-6 col-md-4 col-lg-4">
                    <div class="card-product">
                        
                        <!-- Botão Favorito -->
                        <a href="inserir_favoritos.php?id_produto=<?php echo $id_prod; ?>" class="btn-fav">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg>
                        </a>

                        <!-- Badge Frete -->
                        <span class="badge-frete rounded">FRETE GRÁTIS</span>

                        <a href="produto.php?id_produto=<?php echo $id_prod; ?>" class="text-decoration-none">
                            <div class="img-wrapper">
                                <!-- Imagem Principal -->
                                <img src="<?php echo $linha['imagem']; ?>" class="img-main" alt="<?php echo $linha['nome_produto']; ?>">
                                
                                <!-- Imagem Hover -->
                                <?php if($img_secundaria): ?>
                                    <img src="<?php echo $img_secundaria; ?>" class="img-hover" alt="Detalhe">
                                <?php endif; ?>

                                <!-- Gradiente -->
                                <div class="overlay-gradient"></div>
                            </div>

                            <!-- Informações (Sobrepostas) -->
                            <div class="card-info-overlay">
                                <h5 class="product-title text-uppercase"><?php echo $linha['nome_produto']; ?></h5>
                                <p class="product-price">R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?></p>
                                <p class="installments">ou 3x de R$ <?php echo number_format($linha['preco']/3, 2, ',', '.'); ?> s/juros</p>
                            </div>
                        </a>

                    </div>
                </div>

                <?php 
                    }
                } else {
                    echo "<div class='col-12 text-center py-5'><h4 class='text-muted fw-light'>Nenhum produto encontrado.</h4></div>";
                }
                ?>
            </div>
        </div>
    </main>

    <?php include "components/footer.php";?>

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
            window.location = 'index.php?search='+search.value;
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
    </script>

</body>
</html>
