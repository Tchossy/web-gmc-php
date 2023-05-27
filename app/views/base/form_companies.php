<?php $this->layout('_theme') ?>

<link rel="stylesheet" href="<?= BASE_STYLES . "/styles.css" ?>">

<div class="heroContainerStyles">
  <img src="https://blog.lugarh.com.br/wp-content/uploads/2021/02/Quais-documentos-nao-podem-ser-exigidos-na-admissao.png" alt="">
  <div class="infoHero">
    <div class="path">
      <a href="/">Inicio</a>
      <p> > </p>
      <p> Ficha de Inscrição </p>
      <p> > </p>
      <p> Equipas de Quadros de Empresas </p>
    </div>

    <h1 data-aos="zoom-in-up">Ficha de Inscrição - Equipas de Quadros de Empresas</h1>
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

                <li class="complete">Convite para os eventos promovidos pela Organização</li>
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
        <form id="registerForm">
          <div class="input-block">
            <h4>Preencha o formulário á baixo:</h4>
            <div class="row">
              <div class="col-md-12 p-sm-0">
                <div class="form-group">
                  <label for="name_team">Nome da Equipa</label>
                  <input name="name_team" id="name_team" type="text" class="form-control" placeholder="Nome da Equipa">
                </div>
              </div>

              <div class="col-md-12 p-sm-0" hidden>
                <div class="form-group">
                  <label for="type_team">Tipo de equipa</label>
                  <input name="type_team" id="type_team" value="Equipa de Estudantes" type="text" class="form-control" placeholder="Nome da Equipa">
                </div>
              </div>

              <div class="col-md-12 p-sm-0">
                <div class="form-group">
                  <label for="value_payment_team">Valor de Pagamento</label>
                  <input name="value_payment_team" id="value_payment_team" value="50.000,00Akz" disabled type="text" class="form-control" placeholder="Nome da Equipa">
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
                <button type="button" style="width: 30%;" class="btn btn-primary" id="prevButton" disabled>Voltar</button>
                <button type="button" style="width: 30%;" class="btn btn-primary" id="nextButton">Próximo</button>
                <button type="submit" style="width: 30%;" class="btn btn-success" id="saveButton" disabled>Salvar</button>
              </div>
            </div>
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

    const provinces = [{
        name: 'Benguela',
        cities: [
          'Balombo',
          'Benguela',
          'Baia Farta',
          'Bocoio',
          'Catumbela',
          'Chongoroi',
          'Cubal',
          'Ganda',
          'Lobito'
        ]
      },
      {
        name: 'Bié',
        cities: [
          'Andulo',
          'Catabola',
          'Chinguar',
          'Chitembo',
          'Cuemba',
          'Cunhinga',
          'Camacupa',
          'Kuito',
          'Nharea'
        ]
      },
      {
        name: 'Bengo',
        cities: [
          'Ambriz',
          'Dande',
          'Icolo et Bengo',
          'Muxima',
          'Nambuangongo'
        ]
      },
      {
        name: 'Cabinda',
        cities: ['Belize', 'Buco-Zau', 'Cabinda', 'Cacongo', 'Miconje']
      },
      {
        name: 'Cuando Cubango',
        cities: [
          'Calai',
          'Cuito Cuanavale',
          'Cuchi',
          'Cuangar',
          'Dirico',
          'Longa',
          'Mavinga',
          'Menongue',
          'Rivungo'
        ]
      },
      {
        name: 'Cuanza Norte',
        cities: [
          'Ambaca',
          'Bula Atumba',
          'Banga',
          'Bolongongo',
          'Canbambe',
          'Cazengo',
          'Dembos',
          'Golungo Alto',
          'Gonguembo',
          'Lucala',
          'Pango Aluguem',
          'Quiculungo',
          'Samba Caju'
        ]
      },
      {
        name: 'Cuanza Sul',
        cities: [
          'Amboim',
          'Cassongue',
          'Conda',
          'Ebo',
          'Libolo',
          'Mussende',
          'Porto Amboim',
          'Quibala',
          'Quilenda',
          'Seles (Angola)',
          'Sumbe',
          'Waku-Kungo'
        ]
      },
      {
        name: 'Cunene',
        cities: [
          'Cahama',
          'Cuanhama',
          'Curoca',
          'Cuvelai',
          'Namacunde',
          'Ombadja'
        ]
      },
      {
        name: 'Huila',
        cities: [
          'Chibia',
          'Caconda',
          'Chiange',
          'Chicomba',
          'Chipindo',
          'Caluquembe',
          'Humpata',
          'Jamba',
          'Kuvango',
          'Lubango',
          'Matala',
          'Quilengues',
          'Quipungo'
        ]
      },
      {
        name: 'Huambo',
        cities: [
          'Bailundo',
          'Caála',
          'Catchiungo',
          'Ekunha',
          'Huambo',
          'Londuimbale',
          'Longonjo',
          'Mungo',
          'Tchindjenje',
          'Tchicala-Tcholoanga',
          'Ucuma'
        ]
      },
      {
        name: 'Lunda Norte',
        cities: [
          'Cambulo',
          'Chitato',
          'Cuilo',
          'Camulemba',
          'Cuango',
          'Capenda',
          'Cuangula',
          'Lubalo',
          'Tchitato',
          'Xa Muteba'
        ]
      },
      {
        name: 'Lunda Sul',
        cities: ['Cacolo', 'Dala', 'Muconda', 'Saurimo']
      },
      {
        name: 'Luanda',
        cities: [
          'Cacuaco',
          'Cazenga',
          'Ingombota',
          'Kilamba Kiaxi',
          'Maianga',
          'Rangel',
          'Samba',
          'Sambizanga',
          'Viana'
        ]
      },
      {
        name: 'Malanje',
        cities: [
          'Cambundi-Catembo',
          'Cunda-dia-baza',
          'Cangandala',
          'Calandula',
          'Cuaba Nzogo',
          'Caombo',
          'Caruzo',
          'Luquembo',
          'Malange',
          'Marimba',
          'Massango',
          'Mucari',
          'Quela',
          'Quirima'
        ]
      },
      {
        name: 'Moxico',
        cities: [
          'Alto Zambeze',
          'Bundas',
          'Cameia',
          'Camanongue',
          'Leua',
          'Lucano',
          'Luau',
          'Luchazes',
          'Moxico'
        ]
      },
      {
        name: 'Namibe',
        cities: ['Bibala', 'Camacuio', 'Namibe', 'Tombwa', 'Virei']
      },
      {
        name: 'Uíge',
        cities: [
          'Alto Cauale',
          'Ambuila',
          'Bembe',
          'Buengas',
          'Damba',
          'Macocola',
          'Mucaba',
          'Negage',
          'Puri',
          'Quimbele',
          'Quitexe',
          'Songo',
          'Sanza Pombo',
          'Uíge',
          'Zombo'
        ]
      },
      {
        name: 'Zaire',
        cities: [
          'Cuimba',
          "M'Banza Congo",
          'Noqui',
          "N'Zeto",
          'Soyo',
          'Tomboco'
        ]
      }
    ]

    // Função para gerar campos de integrantes
    function generateMemberFields(memberNumber) {
      var memberFields = `
      <div id="member${memberNumber}">
        <div class="row">
        <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="name_integrante_team_${memberNumber}">Nome do ${memberNumber == 1 ? "líder" : "integrante" } da Equipa ${memberNumber}</label>
              <input name="name_member_${memberNumber}" id="name_integrante_team_${memberNumber}" type="text" class="form-control" placeholder="Nome do ${memberNumber == 1 ? "líder" : "integrante" } da Equipa">
            </div>
          </div>

          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="identity_card_integrante_team_${memberNumber}">Bilhete de Identidade ${memberNumber}</label>
              <input name="identity_card_member_${memberNumber}" id="identity_card_integrante_team_${memberNumber}" type="text" class="form-control"
                placeholder="Bilhete de Identidade">
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="nif_integrante_team_${memberNumber}">NIF  ${memberNumber}</label>
              <input name="nif_member_${memberNumber}" id="nif_integrante_team_${memberNumber}" type="text" class="form-control" placeholder="NIF">
            </div>
          </div>

          <div class="col-md-2 p-sm-0">
            <div class="form-group">
              <label for="age_integrante_team_${memberNumber}">Idade  ${memberNumber}</label>
              <input name="age_member_${memberNumber}" id="age_integrante_team_${memberNumber}" type="text" class="form-control" placeholder="Idade">
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="telephone_integrante_team_${memberNumber}">Telefone  ${memberNumber}</label>
              <input name="telephone_member_${memberNumber}" id="telephone_integrante_team_${memberNumber}" type="text" class="form-control"
                placeholder="Telefone">
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="household_integrante_team_${memberNumber}">Morada  ${memberNumber}</label>
              <input name="household_member_${memberNumber}" id="household_integrante_team_${memberNumber}" type="text" class="form-control"
                placeholder="Morada">
            </div>
          </div>

          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="email_integrante_team_${memberNumber}">Email  ${memberNumber}</label>
              <input name="email_member_${memberNumber}" id="email_integrante_team_${memberNumber}" type="text" class="form-control" placeholder="Email">
            </div>
          </div>

          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="selectProvince${memberNumber}">Província ${memberNumber}</label>
              <div class="select-input">
                <span></span>
                <select name="province_member_${memberNumber}" id="selectProvince${memberNumber}" type="text" class="form-control required"
                  required="">
                  <option value="">Selecione a Província</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="selectCounty${memberNumber}">Município ${memberNumber}</label>
              <div class="select-input">
                <span></span>
                <select name="county_member_${memberNumber}" id="selectCounty${memberNumber}" type="text" class="form-control required" required="">
                  <option value="">Selecione o Município</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="company_integrante_team_${memberNumber}">Nome da Empresa ${memberNumber}</label>
              <input name="company_integrante_team_${memberNumber}"
                id="company_integrante_team_${memberNumber}" type="text" class="form-control"
                placeholder="Nome da Empresa">
            </div>
          </div>

          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="function_integrante_team_${memberNumber}">Função ${memberNumber}</label>
              <input name="function_integrante_team_${memberNumber}"
                id="function_integrante_team_${memberNumber}" type="text" class="form-control"
                placeholder="Função">
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="skills_integrante_team_${memberNumber}">Habilitações Literárias
                ${memberNumber}</label>
              <input name="skills_integrante_team_${memberNumber}"
                id="skills_integrante_team_${memberNumber}" type="text" class="form-control"
                placeholder="Habilitações Literárias">
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

    // Inicialização
    $("#numMembers").trigger("change");

    for (var i = 1; i <= numMembers; i++) {
      const newIndex = i
      const selectProvincia = $('#selectProvince' + i);
      const selectCidade = $('#selectCounty' + i);

      function preencherCidades() {
        selectCidade.empty();
        const provinciaSelecionada = selectProvincia.val();
        const provincia = provinces.find(p => p.name === provinciaSelecionada);

        if (provincia) {
          provincia.cities.forEach(cidade => {
            const option = $('<option>').text(cidade).val(cidade);
            selectCidade.append(option);
          });
        }
      }

      provinces.forEach(provincia => {
        const option = $('<option>').text(provincia.name).val(provincia.name);
        selectProvincia.append(option);
      });

      selectProvincia.on('change', preencherCidades);

      // >>>>>> PROVÍNCIA <<<<<<<
      const baseURL = '/base/controllers/'
      const dashboardURL = '/dashboard/controllers/'

      const numUniversity = i

      const listUniversity = async () => {
        await fetch(
            dashboardURL + 'facultyControllers.php?typeForm=get_all_university'
          )
          .then(response => response.json())
          .then(data => {
            // Itera sobre os dados retornados e adiciona opções ao select
            data.forEach(row => {
              const option = $('<option>').text(row.name_university).val(row.name_university);
              $('#selectUniversity' + numUniversity).append(option)
            })
          })
          .catch(error => console.error('Erro:', error))
      }
      listUniversity()

      // >>>>>> CHANGE UNIVERSITY <<<<<<<
      $('#selectUniversity' + i).change(function(e) {

        $('#selectCourse' + numUniversity).empty()
        const newCourseOption = $('<option>').text('Selecione a Faculdade');
        $('#selectCourse' + numUniversity).append(newCourseOption)

        const selectUniversityName = e.target.value

        // listFaculty
        const listFaculty = async () => {
          $('#selectFaculty' + numUniversity).empty()

          const newOption = $('<option>').text('Selecione a Faculdade');
          $('#selectFaculty' + numUniversity).append(newOption)

          await fetch(
              dashboardURL + 'facultyControllers.php?typeForm=get_all_data_faculty&nameUniversity=' +
              selectUniversityName
            )
            .then(response => response.json())
            .then(faculty => {
              // Itera sobre os dados retornados e adiciona opções ao select
              faculty.forEach(row => {
                const option = $('<option>').text(row.name_faculty).val(row.name_faculty);
                $('#selectFaculty' + numUniversity).append(option)
              })
            })
            .catch(error => console.error('Erro:', error))
        }
        listFaculty()
      })

      // >>>>>> CHANGE UNIVERSITY <<<<<<<
      $('#selectFaculty' + i).change(function(e) {

        const selectFacultyName = e.target.value

        // listCourse
        const listCourse = async () => {
          $('#selectCourse' + numUniversity).empty()

          const newOption = $('<option>').text('Selecione o Curso');
          $('#selectCourse' + numUniversity).append(newOption)

          await fetch(
              dashboardURL + 'courseControllers.php?typeForm=get_all_data_course&nameFaculty=' +
              selectFacultyName
            )
            .then(response => response.json())
            .then(course => {
              // Itera sobre os dados retornados e adiciona opções ao select
              course.forEach(row => {
                const option = $('<option>').text(row.name_course).val(row.name_course);
                $('#selectCourse' + numUniversity).append(option)
              })
            })
            .catch(error => console.error('Erro:', error))
        }
        listCourse()
      })
    }
  });
</script>