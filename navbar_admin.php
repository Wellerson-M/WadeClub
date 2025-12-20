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
    }
</style>

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
        <li class="nav-item"><a class="nav-link nav-link-street" href="categoria.php">PRODUTOS</a></li>
        <li class="nav-item"><a class="nav-link nav-link-street" href="carrinho.php">CARRINHO</a></li>
        <li class="nav-item"><a class="nav-link nav-link-street" href="favoritos.php">FAVORITOS</a></li>
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
        <p><a href="categoria.php" class="text-reset text-decoration-none">PRODUTOS</a></p>
        <p><a href="Carrinho.php" class="text-reset text-decoration-none">CARRINHO</a></p>
        <p><a href="favoritos.php" class="text-reset text-decoration-none">FAVORITOS</a></p>
        <p><a href="informacoes_endereco.php" class="text-reset text-decoration-none">ENDEREÇOS</a></p>
        <p><a href="informacoes_usuario.php" class="text-reset text-decoration-none">MEUS DADOS</a></p>
        <p><a href="sair.php" class="text-reset text-decoration-none">SAIR</a></p>
    </div>
</div>

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
