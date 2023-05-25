<?php $this->layout("_theme"); ?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Equipas</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Equipas</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#">Listagem</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#teamCreateModal">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Nova equipa</span>
  </button>
</div>

<!-- MODAL -->
<div id="teamCreateModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar nova equipa</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form class="modalForm">
      <div class="input-block">
        <div class="row">
          <div>
            <label for="name_team">Nome da Equipa</label>
            <input name="name_team" id="name_team" type="text" class="form-control" placeholder="Nome da Equipa">
          </div>

          <hr>
          <br>

          <div class="input-block">
            <h4>Participantes</h4>
            <p>Selecione o número de integrantes da sua equipe, e preencha os dados de cada um.</p>

            <div>
              <label for="numMembers">Número de Integrantes:</label>
              <div class="select-input">
                <span></span>
                <select name="numMembers" class="form-control" id="numMembers">
                  <option value="3">3 Membros</option>
                  <option value="4">4 Membros</option>
                  <option value="5">5 Membros</option>
                  <!-- Adicione mais opções conforme necessário -->
                </select>
              </div>
            </div>

            <hr>

            <div class="containerMembersIcons">
              <!-- Os ícones dos integrantes serão gerados dinamicamente aqui -->
            </div>

            <div id="memberSteps">
              <!-- Os campos dos integrantes serão gerados dinamicamente aqui -->
            </div>
          </div>

          <div id="buttonContainer">
            <button type="button" style="width: 30%;" class="base-btn" id="prevButton" disabled>Voltar</button>
            <button type="button" style="width: 30%;" class="base-btn" id="nextButton">Próximo</button>
            <button type="submit" style="width: 30%;" class="base-btn" id="saveButton" disabled>Salvar</button>
          </div>
        </div>
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
        <select name="" id="">
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

      <form class="searchRegister">
        <input type="text" placeholder="Procurar" />
        <button type="submit" class="search-btn">
          <i class="bx bx-search"></i>
        </button>
      </form>
    </div>

    <div class="head">
      <h3>Todas as equipas</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome da Equipa</th>
          <th>Tipo de Equipa</th>
          <th>Nº Participantes</th>
          <th>Valor Pago</th>
          <th>Estado</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_team.js" ?>"></script>
<script src="<?= DASHBOARD_JS . "/jquery-3.6.0.min.js" ?>"></script>
<script src="<?= BASE_JS . "/bootstrap2.min.js" ?>"></script>

<script>
$(document).ready(function() {
  var numMembers = 1; // Número inicial de integrantes
  var currentStep = 1; // Etapa atual
  var totalSteps = 1; // Número total de etapas

  // Função para gerar campos de integrantes
  function generateMemberFields(memberNumber) {
    var memberFields = `
      <div id="member${memberNumber}" class="member-step">
      <div class="row">
          <div class="rowItems">
            <div class="col-md-12 p-sm-0">
              <div >
                <label for="name_integrante_team_${memberNumber}">Nome do ${memberNumber == 1 ? "líder" : "integrante" } da Equipa ${memberNumber}</label>
                <input name="name_integrante_team_${memberNumber}" id="name_integrante_team_${memberNumber}" type="text" class="form-control" placeholder="Nome do integrante da Equipa">
              </div>
            </div>
          </div>

          <div class="rowItems">
            <div class="col-md-6 p-sm-0">
              <div >
                <label for="identity_card_integrante_team_${memberNumber}">Bilhete de Identidade ${memberNumber}</label>
                <input name="identity_card_integrante_team_${memberNumber}" id="identity_card_integrante_team_${memberNumber}" type="text" class="form-control"
                  placeholder="Bilhete de Identidade">
              </div>
            </div>
            <div class="col-md-6 p-sm-0">
              <div >
                <label for="nif_integrante_team_${memberNumber}">NIF  ${memberNumber}</label>
                <input name="nif_integrante_team_${memberNumber}" id="nif_integrante_team_${memberNumber}" type="text" class="form-control" placeholder="NIF">
              </div>
            </div>
          </div>

          <div class="rowItems">
            <div class="col-md-2 p-sm-0">
              <div >
                <label for="age_integrante_team_${memberNumber}">Idade  ${memberNumber}</label>
                <input name="age_integrante_team_${memberNumber}" id="age_integrante_team_${memberNumber}" type="text" class="form-control" placeholder="Idade">
              </div>
            </div>
            <div class="col-md-5 p-sm-0">
              <div >
                <label for="telephone_integrante_team_${memberNumber}">Telefone  ${memberNumber}</label>
                <input name="telephone_integrante_team_${memberNumber}" id="telephone_integrante_team_${memberNumber}" type="text" class="form-control"
                  placeholder="Telefone">
              </div>
            </div>
            <div class="col-md-5 p-sm-0">
              <div >
                <label for="household_integrante_team_${memberNumber}">Morada  ${memberNumber}</label>
                <input name="household_integrante_team_${memberNumber}" id="household_integrante_team_${memberNumber}" type="text" class="form-control"
                  placeholder="Morada">
              </div>
            </div>
          </div>

          <div class="rowItems">
            <div class="col-md-12 p-sm-0">
              <div >
                <label for="email_integrante_team_${memberNumber}">Email  ${memberNumber}</label>
                <input name="email_integrante_team_${memberNumber}" id="email_integrante_team_${memberNumber}" type="text" class="form-control" placeholder="Email">
              </div>
            </div>
          </div>

          <div class="rowItems">
            <div class="col-md-6 p-sm-0">
              <div >
                <label for="province_integrante_team_${memberNumber}">Província ${memberNumber}</label>
                <div class="select-input">
                  <span></span>
                  <select name="province_integrante_team_${memberNumber}" id="province_integrante_team_${memberNumber}" type="text" class="form-control required"
                    required="">
                    <option value="">Selecione o Província</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 p-sm-0">
              <div >
                <label for="county_integrante_team_${memberNumber}">Município ${memberNumber}</label>
                <div class="select-input">
                  <span></span>
                  <select name="county_integrante_team_${memberNumber}" id="county_integrante_team_${memberNumber}" type="text" class="form-control required" required="">
                    <option value="">Selecione o Município</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="rowItems">
            <div class="col-md-6 p-sm-0">
              <div >
                <label for="university_integrante_team_${memberNumber}">Universidade/Instituto ${memberNumber}</label>
                <div class="select-input">
                  <span></span>
                  <select name="university_integrante_team_${memberNumber}" id="university_integrante_team_${memberNumber}" type="text" class="form-control required"
                    required="">
                    <option value="">Escolhe uma opção</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 p-sm-0">
              <div >
                <label for="school_integrante_team_${memberNumber}">Faculdade/Escola ${memberNumber}</label>
                <div class="select-input">
                  <span></span>
                  <select name="school_integrante_team_${memberNumber}" id="school_integrante_team_${memberNumber}" type="text" class="form-control required" required="">
                    <option value="">Selecione a Universidade</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="rowItems">
            <div class="col-md-6 p-sm-0">
              <div >
                <label for="course_integrante_team_${memberNumber}">Curso ${memberNumber}</label>
                <div class="select-input">
                  <span></span>
                  <select name="course_integrante_team_${memberNumber}" id="course_integrante_team_${memberNumber}" type="text" class="form-control required" required="">
                    <option value="">Selecione a Faculdade</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 p-sm-0">
              <div >
                <label for="year_attend_integrante_team_${memberNumber}">Ano de Frequência ${memberNumber}</label>
                <div class="select-input">
                  <span></span>
                  <select name="year_attend_integrante_team_${memberNumber}" id="year_attend_integrante_team_${memberNumber}" type="text" class="form-control required"
                    required="">
                    <option value="">2º Ano</option>
                    <option value="">3º Ano</option>
                    <option value="">4º Ano</option>
                    <option value="">5º Ano</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
    return memberFields;
  }

  // Função para gerar ícones de usuário
  function generateMemberIcons() {
    var icons = "";
    for (var i = 1; i <= numMembers; i++) {
      var iconClass = "fas fa-user";
      if (i < currentStep) {
        iconClass += " text-danger";
      }
      icons += '<i class="' + iconClass + '"></i>';
    }
    return icons;
  }

  // Função para avançar para a próxima etapa
  function nextStep() {
    if (currentStep < totalSteps) {
      $("#member" + currentStep).hide();
      currentStep++;
      $("#member" + currentStep).show();

      // Atualizar os ícones de usuário
      var icons = generateMemberIcons();
      $(".containerMembersIcons").html(icons);

      // Habilitar o botão "Voltar" se não estiver na primeira etapa
      $("#prevButton").prop("disabled", false);

      // Desabilitar o botão "Próximo" se estiver na última etapa
      if (currentStep === totalSteps) {
        $("#nextButton").prop("disabled", true);
        $("#saveButton").prop("disabled", false); // Habilitar o botão "Salvar"
      }
    }
  }

  // Função para voltar para a etapa anterior
  function prevStep() {
    if (currentStep > 1) {
      $("#member" + currentStep).hide();
      currentStep--;
      $("#member" + currentStep).show();

      // Habilitar o botão "Próximo" se não estiver na última etapa
      if (currentStep < totalSteps) {
        $("#nextButton").prop("disabled", false);
        $("#saveButton").prop("disabled", true); // Desabilitar o botão "Salvar"
      }

      // Desabilitar o botão "Voltar" se estiver na primeira etapa
      if (currentStep === 1) {
        $("#prevButton").prop("disabled", true);
      }
    }
  }

  // Lidar com a seleção do número de integrantes
  $("#numMembers").change(function() {
    numMembers = parseInt($(this).val());
    totalSteps = numMembers;
    $("#memberSteps").empty(); // Limpar etapas anteriores
    $(".containerMembersIcons").empty(); // Limpar ícones anteriores

    // Gerar campos para cada integrante
    for (var i = 1; i <= numMembers; i++) {
      $("#memberSteps").append(generateMemberFields(i));
      $(".containerMembersIcons").append(
        '<i class="fas fa-user"></i>'); // Adicionar ícone de usuário para cada integrante
      $("#member" + i).hide(); // Ocultar todos os integrantes inicialmente
    }

    currentStep = 1;
    $("#member1").show(); // Mostrar o primeiro integrante

    // Habilitar o botão "Próximo" e desabilitar o botão "Voltar" na primeira etapa
    $("#prevButton").prop("disabled", true);
    $("#nextButton").prop("disabled", false);
    $("#saveButton").prop("disabled", true); // Desabilitar o botão "Salvar"
  });

  // Lidar com o clique no botão "Próximo"
  $("#nextButton").click(function() {
    nextStep();
  });

  // Lidar com o clique no botão "Voltar"
  $("#prevButton").click(function() {
    prevStep();
  });

  // Lidar com o clique no botão "Salvar"
  $("#saveButton").click(function() {
    // Obter os dados do formulário
    var teamName = $("#teamName").val();
    var teamLeader = $("#teamLeader").val();
    var members = [];

    $(".member-step").each(function(index) {
      var memberName = $(this).find(".memberName").val();
      var memberAge = $(this).find(".memberAge").val();
      members.push({
        name: memberName,
        age: memberAge
      });
    });

    // Fazer algo com os dados (por exemplo, enviar para o servidor)
    console.log("Equipe:", teamName);
    console.log("Chefe da Equipe:", teamLeader);
    console.log("Integrantes:", members);
  });

  // Inicialização
  $("#numMembers").trigger("change");
});
</script>