<?php $this->layout('_theme') ?>
<?php
require 'db/config.php';

if ((!isset($_SESSION['adm_gmc_email']))) {
  header('Location:  /painel');
}

?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Adm</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Adm</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#userModal">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Novo Adm</span>
  </button>
</div>

<!-- MODAL -->
<div id="userModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo Adm</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form id="registerForm" class="modalForm">
      <div>
        <label for="">
          Nome do Adm <span class="text-danger">*</span>
        </label>
        <input name="full_name_adm" class="form-control" type="text" placeholder="Nome do Adm">
      </div>
      <div>
        <label for="">
          E-mail do Adm <span class="text-danger">*</span>
        </label>
        <input name="email_address_adm" class="form-control" type="text" placeholder="E-mail do Adm">
      </div>
      <div>
        <label for="">
          Nº de telefone do Adm <span class="text-danger">*</span>
        </label>
        <input name="number_phone_adm" class="form-control" type="text" placeholder="Nº de telefone">
      </div>
      <div>
        <label for="">
          Permissões do Adm <span class="text-danger">*</span>
        </label>
        <select name="permissions_adm" id="permissions_adm" class="form-control">
          <option value="read">Apenas leitura</option>
          <option value="write">Apenas cadastrar</option>
          <option value="all_permissions">Todas as permissões</option>
        </select>
      </div>
      <div>
        <label for="">
          Password <span class="text-danger">*</span>
        </label>
        <input name="login_password_adm" class="form-control" type="password" placeholder="Password">
      </div>
      <div>
        <label for="">
          Confirme a password <span class="text-danger">*</span>
        </label>
        <input name="login_confirm_password_adm" class="form-control" type="password" placeholder="Confirme a password">
      </div>

      <button class="base-btn" type="submit">
        Dar entrada
      </button>
    </form>
  </div>
</div>

<div id="userEditeModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do Adm</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCad"></span>
    </div>

    <form id="editForm" class="modalForm">
      <input id="id_edit" name="id_adm" hidden>

      <div>
        <label for="">
          Nome do Adm <span class="text-danger">*</span>
        </label>
        <input id="full_name_adm_edit" name="full_name_adm" class="form-control" type="text" placeholder="Nome do Adm">
      </div>
      <div>
        <label for="">
          E-mail do Adm <span class="text-danger">*</span>
        </label>
        <input id="email_address_adm_edit" name="email_address_adm" class="form-control" type="text"
          placeholder="E-mail do Adm">
      </div>
      <div>
        <label for="">
          Permissões do Adm <span class="text-danger">*</span>
        </label>
        <select name="permissions_adm" id="permissions_adm" class="form-control">
          <option value="read">Apenas leitura</option>
          <option value="write">Apenas cadastrar</option>
          <option value="all_permissions">Todas as permissões</option>
        </select>
      </div>
      <div>
        <label for="">
          Nº de telefone do Adm <span class="text-danger">*</span>
        </label>
        <input id="number_phone_adm_edit" name="number_phone_adm" class="form-control" type="text"
          placeholder="Nº de telefone">
      </div>

      <button class="base-btn" type="submit">
        Actualizar dados do Adm
      </button>
    </form>
  </div>
</div>

<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Todos os Adm</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Utilizador</th>
          <th>E-mail</th>
          <th>Nº de telefone</th>
          <th>Permissão</th>
          <th>Data de registo</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_adm_user.js" ?>"></script>