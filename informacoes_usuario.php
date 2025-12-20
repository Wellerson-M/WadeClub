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

    .nav-secondary {
      position: fixed;
      top: 86px;
      left: 0;
      right: 0;
      background-color: white;
      height: 60px;
      border-bottom: 1px solid #ddd;
      display: flex;
      align-items: center;
      z-index: 99;
      transition: top 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .nav-secondary .nav {
      width: 100%;
    }

    .nav-secondary .nav-link {
      color: var(--wade-dark) !important;
      font-weight: 500;
      font-size: 13px;
    }

    .nav-secondary .nav-link:hover {
      color: #666 !important;
    }

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

    main {
      margin-top: 146px;
      padding: 40px 0;
    }

    .card {
      border: none;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

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

    @media (max-width: 768px) {
      .navbar-main {
        height: 70px;
      }

      .nav-secondary {
        height: 50px;
        top: 70px;
      }

      main {
        margin-top: 120px;
      }
    }
  </style>

  <title>Informações do Usuário - Wade Club</title>

</head>

<body><?php include "Components/nav.php"; ?>

<div class="container px-3 px-lg-4">
    <a class="navbar-brand me-3 me-lg-4" href="index.php">
      <img src="img/logo.png" alt="Wade Club">
    </a>
    
    <div class="search-container d-none d-md-flex">
      <input type="search" id="pesquisar" placeholder="O que você está procurando?">
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- NAV SECUNDÁRIA -->
<div class="nav-secondary" id="navSecundaria">
  <div class="container px-3 px-lg-4">
    <ul class="nav justify-content-center flex-nowrap">
      <li><a class="nav-link" href="index.php">HOME</a></li>
      <li><a class="nav-link" href="categoria.php?cat=camiseta">CAMISETAS</a></li>
      <li><a class="nav-link" href="categoria.php?cat=calcas">CALÇAS</a></li>
      <li><a class="nav-link" href="categoria.php?cat=moletom">MOLETOM</a></li>
    </ul>
  </div>
</div>

<!-- OFFCANVAS MENU -->
<div class="offcanvas offcanvas-end offcanvas-street" id="offcanvasMenu">
  <div class="offcanvas-header">
    <h5>WADE CLUB</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p><a href="index.php">HOME</a></p>
    <p><a href="Carrinho.php">CARRINHO</a></p>
    <p><a href="favoritos.php">FAVORITOS</a></p>
    <p><a href="informacoes_usuario.php">MEUS DADOS</a></p>
    <p><a href="informacoes_endereco.php">ENDEREÇOS</a></p>
    <?php if($_SESSION['adm_usuario'] == 1) { ?>
      <p><a href="tela_adm.php">ADMINISTRADOR</a></p>
    <?php } ?>
    <p><a href="sair.php">SAIR</a></p>
  </div>
</div>

<!-- MAIN CONTENT -->
<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
                  fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                      d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                  <path fill-rule="evenodd"
                      d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
              </svg><a href="index.php" class="text-reset text-decoration-none"> Inicio</a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                  <path
                      d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
              </svg><a href="carrinho.php" class="text-reset text-decoration-none"> Minhas compras</a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                  <path
                      d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
              </svg><a href="favoritos.php" class="text-reset text-decoration-none"> Favoritos </a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-gift" viewBox="0 0 16 16">
                  <path
                      d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
              </svg><a href="" class="text-reset text-decoration-none"> Promoções</a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                  <path
                      d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                  <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
              </svg><a href="cartoes.php" class="text-reset text-decoration-none"> Cartões salvos</a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-signpost-split-fill" viewBox="0 0 16 16">
                  <path
                      d="M7 16h2V6h5a1 1 0 0 0 .8-.4l.975-1.3a.5.5 0 0 0 0-.6L14.8 2.4A1 1 0 0 0 14 2H9v-.586a1 1 0 0 0-2 0V7H2a1 1 0 0 0-.8.4L.225 8.7a.5.5 0 0 0 0 .6l.975 1.3a1 1 0 0 0 .8.4h5v5z" />
              </svg><a href="informacoes_endereco.php" class="text-reset text-decoration-none"> Endereços</a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                  <path
                      d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
              </svg><a href="informacoes_usuario.php" class="text-reset text-decoration-none"> Meus dados</a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                      d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                  <path fill-rule="evenodd"
                      d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
              </svg><a href="sair.php" class="text-reset text-decoration-none">Sair</a></p>
    
          <hr>
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                  <path
                      d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
              </svg><a href="" class="text-reset text-decoration-none"> Trocas e devoluçôes</a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                  <path
                      d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
              </svg><a href="" class="text-reset text-decoration-none"> Ajuda</a></p>
    
          <p class="fs-5 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  fill="currentColor" class="bi bi-braces" viewBox="0 0 16 16">
                  <path
                      d="M2.114 8.063V7.9c1.005-.102 1.497-.615 1.497-1.6V4.503c0-1.094.39-1.538 1.354-1.538h.273V2h-.376C3.25 2 2.49 2.759 2.49 4.352v1.524c0 1.094-.376 1.456-1.49 1.456v1.299c1.114 0 1.49.362 1.49 1.456v1.524c0 1.593.759 2.352 2.372 2.352h.376v-.964h-.273c-.964 0-1.354-.444-1.354-1.538V9.663c0-.984-.492-1.497-1.497-1.6zM13.886 7.9v.163c-1.005.103-1.497.616-1.497 1.6v1.798c0 1.094-.39 1.538-1.354 1.538h-.273v.964h.376c1.613 0 2.372-.759 2.372-2.352v-1.524c0-1.094.376-1.456 1.49-1.456V7.332c-1.114 0-1.49-.362-1.49-1.456V4.352C13.51 2.759 12.75 2 11.138 2h-.376v.964h.273c.964 0 1.354.444 1.354 1.538V6.3c0 .984.492 1.497 1.497 1.6z" />
              </svg><a href="" class="text-reset text-decoration-none"> Sobre WadeClub </a></p>
    
        </div>
    </div>

        <h2 class="mb-4">Meus Dados</h2>

        <div class="card mb-4">
            <div class="card-body">
                <?php
                    $query_usuario = "SELECT * FROM usuario WHERE id_usuario = :id_usuario  LIMIT 1";  
                    $result_usuario = $pdo->prepare($query_usuario);
                    $result_usuario->bindParam(':id_usuario', $_SESSION['id_usuario']);

                    $result_usuario->execute();

                    if(($result_usuario) AND ($result_usuario->rowCount() != 0 )){
                        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                        
                        $value = $row_usuario['CPF'];

                        
                        $_SESSION['email'] = $row_usuario['email'];
                        $_SESSION['nome'] = $row_usuario['nome'];
                        $_SESSION['sobrenome'] = $row_usuario['sobrenome'];
                        $_SESSION['CPF'] = $value;
                        $_SESSION['nascimento'] = $row_usuario['nascimento'];
                    }
                ?>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext"><?php echo $_SESSION["email"]; ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nome</label>
                        <p class="form-control-plaintext"><?php echo $_SESSION["nome"]; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sobrenome</label>
                        <p class="form-control-plaintext"><?php echo $_SESSION["sobrenome"]; ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">CPF</label>
                        <p class="form-control-plaintext"><?php echo $_SESSION["CPF"]; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Data de Nascimento</label>
                        <p class="form-control-plaintext"><?php echo $_SESSION["nascimento"]; ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Alterar Dados
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#senhamodal">
                    Alterar Senha
                </button>
            </div>
        </div>

        <!-- MODAL EDITAR DADOS -->
        <form action="editar_usuario.php" method="POST">
            <div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Informações</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="d-none" value="<?php echo $_SESSION['id_usuario']; ?>" name="id_usuario">
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control" value="<?php echo $_SESSION['nome']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sobrenome</label>
                                <input type="text" name="sobrenome" class="form-control" value="<?php echo $_SESSION['sobrenome']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">CPF</label>
                                <input type="text" name="CPF" class="form-control" value="<?php echo $_SESSION['CPF']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data de Nascimento</label>
                                <input type="text" name="nascimento" class="form-control" value="<?php echo $_SESSION['nascimento']; ?>" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Salvar Alterações">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- MODAL ALTERAR SENHA -->
        <form action="editar_senha.php" method="POST">
            <div class="modal fade" data-bs-backdrop="static" id="senhamodal" tabindex="-1" aria-labelledby="senhaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="senhaModalLabel">Alterar Senha</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nova Senha</label>
                                <input type="password" name="senha" class="form-control" placeholder="Digite sua nova senha" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Alterar Senha">
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </main>

<?php include "Components/footer.php"; ?>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
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

  // Navbar scroll logic
  let lastScrollTop = 0;
  const navSecundaria = document.getElementById('navSecundaria');
  const headerHeight = document.getElementById('navbarMain').offsetHeight;

  window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop && scrollTop > 100) {
      navSecundaria.style.top = '-60px'; 
    } else {
      navSecundaria.style.top = headerHeight + 'px';
    }
    lastScrollTop = scrollTop;
  });
</script>

</body>
</html>
