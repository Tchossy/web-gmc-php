<?php $this->layout("_theme"); ?>

<div class="head-title">
  <div class="left">
    <h1>Painel</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Casa</a>
      </li>
    </ul>
  </div>
</div>

<ul class="box-info">
  <li>
    <i class="bx bxs-group"></i>
    <span class="text">
      <h3 id="num_teams">30</h3>
      <p>Nº Equipes</p>
    </span>
  </li>
  <li>
    <i class="fas fa-users"></i>
    <span class="text">
      <h3 id="num_members">2834</h3>
      <p>Nº Membros</p>
    </span>
  </li>
</ul>
<ul class="box-info2">
  <li>
    <i class="fas fa-money-bill-wave"></i>
    <span class="text">
      <h3 id="num_paid_out"></h3>
      <p>Valor Pago</p>
    </span>
  </li>
  <li>
    <i class="fas fa-hand-holding-usd"></i>
    <span class="text">
      <h3 id="num_pending"></h3>
      <p>Valores Pendentes</p>
    </span>
  </li>
</ul>

<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Resumo das Equipas</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome da Equipa</th>
          <th>Tipo de Equipa</th>
          <th>Nº Participantes</th>
          <th>Valor Pago</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_home.js" ?>"></script>