<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>GMC - Painel</title>


  <!-- Custom Css -->
  <link rel="stylesheet" type="text/css" href="<?= DASHBOARD_STYLES . "/style.css" ?>">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" href="<?= DASHBOARD_IMG . "/favicon.png" ?>">
  <link rel="apple-touch-icon" href="<?= DASHBOARD_IMG . "/apple-touch-icon.png" ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= DASHBOARD_IMG . "/icon-72x72.png" ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= DASHBOARD_IMG . "/icon-114x114.png" ?>">

  <!-- Icons -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<!-- SIDEBAR -->
<section id="sidebar">
  <a href="home" class="brand">
    <img style="width: 12.6rem;" src="<?= DASHBOARD_IMG . "/logo.png" ?>" class="logo" alt="" />
  </a>
  <ul class="side-menu top">
    <li>
      <a href="/painel/home">
        <i class="bx bxs-dashboard"></i>
        <span class="text">Painel</span>
      </a>
    </li>
    <li>
      <a href="/painel/team">
        <i class='bx bxs-group'></i>
        <span class="text">Equipe</span>
      </a>
    </li>
    <li>
      <a href="/painel/university">
        <i class='bx bxs-graduation'></i>
        <span class="text">Universidades</span>
      </a>
    </li>
    <li>
      <a href="/painel/faculty">
        <i class='bx bxs-book'></i>
        <span class="text">Faculdades</span>
      </a>
    </li>
    <li>
      <a href="/painel/course">
        <i class='bx bxs-bookmarks'></i>
        <span class="text">Curso</span>
      </a>
    </li>
  </ul>
  <ul class="side-menu">
    <li>
      <a href="#">
        <i class="bx bxs-cog"></i>
        <span class="text">Configurações</span>
      </a>
    </li>
    <li>
      <a id="logout" class="logout">
        <i class="bx bxs-log-out-circle"></i>
        <span class="text">Sair do painel</span>
      </a>
    </li>
  </ul>
</section>
<!-- SIDEBAR -->

<!-- CONTENT -->
<section id="content">
  <!-- NAVBAR -->
  <nav>
    <i class="bx bx-menu"></i>
    <form action="#">
    </form>

    <form action="#" hidden>
      <div class="form-input">
        <button type="submit" class="search-btn">
          <i class="bx bx-search"></i>
        </button>
      </div>
    </form>
    <input type="checkbox" id="switch-mode" hidden />
    <label for="switch-mode" class="switch-mode"></label>

    <div class="row" style="display: flex;align-items: center;gap: 0.6rem;">
      <div class="profile">
        <img src="https://www.pngfind.com/pngs/m/470-4703547_icon-user-icon-hd-png-download.png" />
      </div>
      <div class="containerInfoAdm">
        <p id="name_adm">Rafael Pilarte</p>
        <p id="email_adm">rafaelpilarte.rlps@gmail.com</p>
      </div>
    </div>
  </nav>
  <!-- NAVBAR -->

  <!-- MAIN -->
  <main>

    <?= $this->section('content') ?>

  </main>
  <!-- MAIN -->
</section>
<!-- CONTENT -->

</html>

<script src="<?= DASHBOARD_JS . "/script.js" ?>"></script>
<script src="<?= DASHBOARD_JS . "/sweetalert.min.js" ?>"></script>