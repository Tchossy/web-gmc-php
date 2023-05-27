<?php $this->layout("_theme"); ?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Faculdades</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Faculdades</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#">Listagem</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#createModal">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Nova faculdade</span>
  </button>
</div>

<!-- MODAL -->
<div id="createModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo faculdade</h2>
    </div>

    <form id="registerForm" class="modalForm">
      <span id="msgAlertaErroCad"></span>

      <div>
        <label for="name_faculty">
          Nome do faculdade <span class="text-danger">*</span>
        </label>
        <input name="name_faculty" class="form-control" type="text" placeholder="Ex.: Faculdade de Ciências de Engenharia e Tecnologia" require>
      </div>
      <div>
        <label for="ref_faculty">
          Referencia da faculdade <span class="text-danger">*</span>
        </label>
        <input name="ref_faculty" class="form-control" type="text" placeholder="Ex.: fau_cien_eng_tec" require>
      </div>
      <div>
        <label for="name_university">
          Selecione a universidade <span class="text-danger">*</span>
        </label>
        <select name="name_university" id="universitySelect" class="form-control" require>
          <option value="">Escolha uma opção</option>
        </select>
      </div>

      <button class="base-btn" type="submit">
        Cadastrar
      </button>
    </form>
  </div>
</div>

<div id="editeModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do faculdade</h2>
    </div>

    <form id="editForm" class="modalForm">
      <input id="id_edit" name="idFaculty" hidden>
      <span id="msgAlertaErroEditCard"></span>

      <div>
        <label for="name_faculty">
          Nome do faculdade <span class="text-danger">*</span>
        </label>
        <input id="name_faculty_edit" name="name_faculty" class="form-control" type="text" placeholder="Ex.: Universidade Independente de Angola">
      </div>
      <div>
        <label for="ref_faculty">
          Referencia da faculdade <span class="text-danger">*</span>
        </label>
        <input id="ref_faculty_edit" name="ref_faculty" class="form-control" type="text" placeholder="Ex.: uni_ind_ang">
      </div>
      <div>
        <label for="name_university">
          Selecione a universidade <span class="text-danger">*</span>
        </label>
        <select name="name_university" id="university_select_edit" class="form-control" require>
          <option value="">Escolha uma opção</option>
        </select>
      </div>

      <button class="base-btn" type="submit">
        Actualizar dados do faculdade
      </button>
    </form>
  </div>
</div>

<div id="seeModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Visualizar dados do faculdade</h2>
    </div>

    <form id="seeForm" class="modalForm">
      <input id="id_see" name="id_faculty" hidden>
      <span id="msgAlertaErroEditCad"></span>

      <div>
        <label for="">
          Nome do faculdade <span class="text-danger">*</span>
        </label>
        <input id="name_faculty_see" name="name_faculty" class="form-control" type="text" placeholder="Ex.: Universidade Independente de Angola" disabled>
      </div>
      <div>
        <label for="">
          Referencia da faculdade <span class="text-danger">*</span>
        </label>
        <input id="ref_faculty_see" name="ref_faculty" class="form-control" type="text" placeholder="Ex.: uni_ind_ang" disabled>
      </div>
      <div>
        <label for="name_university">
          Nome da universidade <span class="text-danger">*</span>
        </label>
        <input name="name_university" id="select_university_see" class="form-control" disabled require>
      </div>

    </form>
  </div>
</div>

<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="containerFilter">
      <div class="numRegister">
        <span>Registos por pagina</span>
        <select name="" id="numRegister">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="25">25</option>
          <option value="30">30</option>
          <option value="35">35</option>
          <option value="40">40</option>
          <option value="45">45</option>
          <option value="50">50</option>
        </select>
      </div>

      <form class="searchRegister" id='searchRegister'>
        <input type="text" placeholder="Procurar" id="searchRegisterValue" />
        <button type="submit" class="search-btn">
          <i class="bx bx-search"></i>
        </button>
      </form>
    </div>

    <div class="head">
      <h3>Todas as faculdades</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Ref</th>
          <th>Faculdade</th>
          <th>Universidade</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_faculty.js" ?>"></script>