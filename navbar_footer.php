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

<script>
    var search = document.getElementById('pesquisar');
    if(search) {
        search.addEventListener("keydown", function(event){
            if (event.key === "Enter") {
                searchData();
            }
        });
    }
    function searchData() {
        var searchValue = document.getElementById('pesquisar').value;
        if(searchValue) {
            window.location = 'categoria.php?search='+searchValue;
        }
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
