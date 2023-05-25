<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>GMC - Global Management Challenge</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/bootstrap.min.css" ?>">

  <!-- External Css -->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/line-awesome.min.css" ?>">

  <!-- Custom Css -->
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/main.css" ?>">
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/tchossy-2.css" ?>">
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/contact-3.css" ?>">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" href="<?= BASE_IMG . "/favicon.png" ?>">
  <link rel="apple-touch-icon" href="<?= BASE_IMG . "/apple-touch-icon.png" ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= BASE_IMG . "/icon-72x72.png" ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= BASE_IMG . "/icon-114x114.png" ?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<body>

  <div class="ugf-nav">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="navigation">
            <div class="logo">
              <a href="https://inscricao.gmc.ao/"><img src="<?= BASE_IMG . "/logo-dark.png" ?>" class="img-fluid"
                  style="width: 20rem;" alt=""></a>
            </div>
            <div class="nav-btns">
              <a href="/" class="get">VOLTAR PARA O SITE</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $this->section("content") ?>


  <footer class="pt30">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="footer-wrap">
            <ul class="footer-nav">
              <li><a href="https://gmc.ao/quem-somos/">Quem Somos</a></li>
              <li><a href="https://gmc.ao/como-participar/#como-funciona">Como funciona</a></li>
              <li><a href="https://gmc.ao/blog/">Notícias</a></li>
            </ul>
            <div class="copyright">
              <p>Copyright © 2022-2024 <a href="https://loneus.biz/">SOIK INVESTMENTS</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?= BASE_JS . "/jquery.min.js" ?>"></script>
  <script src="<?= BASE_JS . "/popper.min.js" ?>"></script>
  <script src="<?= BASE_JS . "/bootstrap.min.js" ?>"></script>
  <script src="<?= DASHBOARD_JS . "/sweetalert.min.js" ?>"></script>

  <!-- <script src="../assets/js/owl.carousel.min.js"></script> -->
  <!-- <script src="../assets/js/countrySelect.min.js"></script> -->

  <script src="<?= BASE_JS . "/custom.js" ?>"></script>
</body>

</html>