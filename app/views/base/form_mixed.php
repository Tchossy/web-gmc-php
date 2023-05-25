<?php $this->layout('_theme') ?>

<link rel="stylesheet" href="<?= BASE_STYLES . "/styles.css" ?>">

<div class="heroContainerStyles">
  <img
    src="https://blog.lugarh.com.br/wp-content/uploads/2021/02/Quais-documentos-nao-podem-ser-exigidos-na-admissao.png"
    alt="">
  <div class="infoHero">
    <div class="path">
      <a href="/">Inicio</a>
      <p> > </p>
      <p> Ficha de Inscrição </p>
      <p> > </p>
      <p> Equipas Mistas </p>
    </div>

    <h1 data-aos="zoom-in-up">Ficha de Inscrição - Equipas Mistas</h1>
  </div>
  <div class="shadow"></div>
</div>

<div class="containerInfo">
  <h1>Fichas de Inscrição</h1>
  <h2>Global Management Challenge</h2>
  <p>Seleccione a ficha de inscrição que se adequa ao perfil da sua equipa:</p>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 p-sm-0">
        <div class="ugf-form">
          <div class="input-block">
            <div class="conditions">
              <p style="color: var(--primary); margin-top: 4rem;">O valor de inscrição de uma equipa no Global
                Management Challenge é
                50.000,00 Kz
                inclui:</p>
              <ul>
                <li class="complete">Participação de uma equipa de 3 a 5 elementos</li>
                <li class="complete">Documentação sobre a competição</li>
                <li class="complete">Acesso à simulação na área de competição</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-8 offset-lg-2 p-sm-0">
      <div class="ugf-form">
        <form action="#">
          <div class="input-block">
            <h4>Preencha o formulário á baixo:</h4>
            <div class="row">
              <div class="col-md-12 p-sm-0">
                <div class="form-group">
                  <label for="name_team">Nome da Equipa</label>
                  <input name="name_team" id="name_team" type="text" class="form-control" placeholder="Nome da Equipa">
                </div>
              </div>

              <div class="col-md-12 p-sm-0">
                <div class="form-group">
                  <label for="type_team">Tipo de equipa</label>
                  <input name="type_team" id="type_team" value="Equipas Mistas" disabled type="text"
                    class="form-control" placeholder="Nome da Equipa">
                </div>
              </div>

              <div class="col-md-12 p-sm-0">
                <div class="form-group">
                  <label for="value_payment_team">Valor de Pagamento</label>
                  <input name="value_payment_team" id="value_payment_team" value="50.000,00Akz" disabled type="text"
                    class="form-control" placeholder="Nome da Equipa">
                </div>
              </div>

              <div class="input-block">
                <h4>Participantes</h4>
                <p>Selecione o número de integrantes da sua equipe, e preencha os dados de cada um.</p>

                <div class="col-md-6 p-sm-0">
                  <div class="form-group ">
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
                <button type="button" style="width: 30%;" class="btn btn-primary" id="prevButton"
                  disabled>Voltar</button>
                <button type="button" style="width: 30%;" class="btn btn-primary" id="nextButton">Próximo</button>
                <button type="submit" style="width: 30%;" class="btn btn-success" id="saveButton"
                  disabled>Salvar</button>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="<?= BASE_ACTIONS . "/actions_team.js" ?>"></script>
<script src="<?= BASE_JS . "/jquery-3.6.0.min.js" ?>"></script>
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
          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="name_member_team_${memberNumber}">Nome do ${memberNumber == 1 ? "líder" : "integrante" } da Equipa ${memberNumber}</label>
              <input name="name_member_${memberNumber}" id="name_member_team_${memberNumber}" type="text" class="form-control" placeholder="Nome do ${memberNumber == 1 ? "líder" : "integrante" } da Equipa">
            </div>
          </div>

          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="identity_card_member_team_${memberNumber}">Bilhete de Identidade ${memberNumber}</label>
              <input name="identity_card_member_${memberNumber}" id="identity_card_member_team_${memberNumber}" type="text" class="form-control"
                placeholder="Bilhete de Identidade">
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="nif_member_team_${memberNumber}">NIF  ${memberNumber}</label>
              <input name="nif_member_${memberNumber}" id="nif_member_team_${memberNumber}" type="text" class="form-control" placeholder="NIF">
            </div>
          </div>

          <div class="col-md-2 p-sm-0">
            <div class="form-group">
              <label for="age_member_team_${memberNumber}">Idade  ${memberNumber}</label>
              <input name="age_member_${memberNumber}" id="age_member_team_${memberNumber}" type="text" class="form-control" placeholder="Idade">
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="telephone_member_team_${memberNumber}">Telefone  ${memberNumber}</label>
              <input name="telephone_member_${memberNumber}" id="telephone_member_team_${memberNumber}" type="text" class="form-control"
                placeholder="Telefone">
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="household_member_team_${memberNumber}">Morada  ${memberNumber}</label>
              <input name="household_member_${memberNumber}" id="household_member_team_${memberNumber}" type="text" class="form-control"
                placeholder="Morada">
            </div>
          </div>

          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="email_member_team_${memberNumber}">Email  ${memberNumber}</label>
              <input name="email_member_${memberNumber}" id="email_member_team_${memberNumber}" type="text" class="form-control" placeholder="Email">
            </div>
          </div>

          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="province_member_team_${memberNumber}">Província ${memberNumber}</label>
              <div class="select-input">
                <span></span>
                <select name="province_member_${memberNumber}" id="province_member_team_${memberNumber}" type="text" class="form-control required"
                  required="">
                  <option value="">Selecione o Província</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="county_member_team_${memberNumber}">Município ${memberNumber}</label>
              <div class="select-input">
                <span></span>
                <select name="county_member_${memberNumber}" id="county_member_team_${memberNumber}" type="text" class="form-control required" required="">
                  <option value="">Selecione o Município</option>
                </select>
              </div>
            </div>
          </div>

          <div class="documents-upload-wrap">
            <div class="label">Estado</div>
            <ul class="nav nav-tabs nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="estudante${memberNumber}-tab" data-bs-toggle="pill" href="#estudante${memberNumber}" role="tab"
                  aria-controls="estudante${memberNumber}" aria-selected="true"><img src="assets/images/estudante.png"
                    alt="">Estudante</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="quadro${memberNumber}-tab" data-bs-toggle="pill" href="#quadro${memberNumber}" role="tab"
                  aria-controls="quadro${memberNumber}" aria-selected="false"><img src="assets/images/quadro.png" alt="">Quadro</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="estudante${memberNumber}" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <div class="col-md-6 p-sm-0">
                    <div class="form-group ">
                      <label for="university_member_team">Universidade/Instituto ${memberNumber}</label>
                      <div class="select-input">
                        <span></span>
                        <select name="university_member_${memberNumber}" id="university_member_team" type="text"
                          class="form-control required" required="">
                          <option value="">Escolhe uma opção</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 p-sm-0">
                    <div class="form-group ">
                      <label for="school_member_team">Faculdade/Escola ${memberNumber}</label>
                      <div class="select-input">
                        <span></span>
                        <select name="school_member_${memberNumber}" id="school_member_team" type="text"
                          class="form-control required" required="">
                          <option value="">Selecione a Universidade</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 p-sm-0">
                    <div class="form-group ">
                      <label for="course_member_team">Curso ${memberNumber}</label>
                      <div class="select-input">
                        <span></span>
                        <select name="course_member_${memberNumber}" id="course_member_team" type="text"
                          class="form-control required" required="">
                          <option value="">Selecione a Faculdade</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 p-sm-0">
                    <div class="form-group ">
                      <label for="year_attend_member_team">Ano de Frequência ${memberNumber}</label>
                      <div class="select-input">
                        <span></span>
                        <select name="year_attend_member_${memberNumber}" id="year_attend_member_team" type="text"
                          class="form-control required" required="">
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

              <div class="tab-pane fade" id="quadro${memberNumber}" role="tabpanel" aria-labelledby="quadro${memberNumber}-tab">
                <div class="tab-pane fade show active" id="estudante" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row">
                    <div class="col-md-12 p-sm-0">
                      <div class="form-group">
                        <label for="company_member_team_${memberNumber}">Nome da Empresa ${memberNumber}</label>
                        <input name="company_member_${memberNumber}"
                          id="company_member_team_${memberNumber}" type="text" class="form-control"
                          placeholder="Nome da Empresa">
                      </div>
                    </div>

                    <div class="col-md-6 p-sm-0">
                      <div class="form-group">
                        <label for="function_member_team_${memberNumber}">Função ${memberNumber}</label>
                        <input name="function_member_${memberNumber}"
                          id="function_member_team_${memberNumber}" type="text" class="form-control"
                          placeholder="Função">
                      </div>
                    </div>
                    <div class="col-md-6 p-sm-0">
                      <div class="form-group">
                        <label for="skills_member_team_${memberNumber}">Habilitações Literárias
                          ${memberNumber}</label>
                        <input name="skills_member_${memberNumber}"
                          id="skills_member_team_${memberNumber}" type="text" class="form-control"
                          placeholder="Habilitações Literárias">
                      </div>
                    </div>
                  </div>
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
  // $("#saveButton").click(function() {
  //   var teamName = $("#teamName").val();
  //   var teamLeader = $("#teamLeader").val();
  //   var members = [];

  //   $(".member-step").each(function(index) {
  //     var memberName = $(this).find(".memberName").val();
  //     var memberAge = $(this).find(".memberAge").val();
  //     members.push({
  //       name: memberName,
  //       age: memberAge
  //     });
  //   });

  //   // Fazer algo com os dados (por exemplo, enviar para o servidor)
  //   console.log("Equipe:", teamName);
  //   console.log("Chefe da Equipe:", teamLeader);
  //   console.log("Integrantes:", members);
  // });

  // Inicialização
  $("#numMembers").trigger("change");
});
</script>