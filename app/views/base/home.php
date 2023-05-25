<?php $this->layout("_theme"); ?>

<link rel="stylesheet" href="<?= BASE_STYLES . "/styles.css" ?>">

<div class="heroContainerStyles">
  <img src="https://blog.lugarh.com.br/wp-content/uploads/2021/02/Quais-documentos-nao-podem-ser-exigidos-na-admissao.png" alt="">
  <div class="infoHero">
    <div class="path">
      <a href="/">Inicio</a>
      <p> > </p>
      <p> Ficha de Inscrição </p>
    </div>

    <h1 data-aos="zoom-in-up">Ficha de Inscrição</h1>
  </div>
  <div class="shadow"></div>
</div>

<div class="containerInfo">
  <h1>Fichas de Inscrição</h1>
  <h2>Global Management Challenge</h2>
  <p>Seleccione a ficha de inscrição que se adequa ao perfil da sua equipa:</p>
</div>

<div class="pb30">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="contact-block">
          <div class="contact-info">
            <div class="icon">
              <img src="<?= BASE_IMG . "/icons/equipe.png" ?>" class="img-fluid" alt="">
            </div>
            <h4>Equipa de Estudantes
            </h4>
            <a href="/form_student" class="btn-base">
              <span>Inscreva-se aqui</span>
            </a>
          </div>

          <div class="contact-info">
            <div class="icon">
              <img src="<?= BASE_IMG . "/icons/companhia.png" ?>" class="img-fluid" alt="">
            </div>
            <h4>Equipas de Quadros de Empresas</h4>
            <a href="/form_companies" class="btn-base">
              <span>Inscreva-se aqui</span>
            </a>
          </div>

          <div class="contact-info">
            <div class="icon">
              <img src="<?= BASE_IMG . "/icons/recursos-humanos.png" ?>" class="img-fluid" alt="">
            </div>
            <h4>Equipas Mistas</h4>
            <a href="/form_mixed" class="btn-base">
              <span>Inscreva-se aqui</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>