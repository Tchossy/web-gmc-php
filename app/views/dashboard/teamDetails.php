<?php $this->layout("_theme");


require 'db/config.php';

if ((!isset($_SESSION['adm_gmc_email']))) {
  header('Location:  /painel');
}

$currentURL = $_SERVER['REQUEST_URI'];

// Obtém a última parte da URI
$parts = explode('/', $currentURL);
$lastPart = end($parts);

$result_team = $pdo->prepare("SELECT * FROM team WHERE id = ? ORDER BY id LIMIT 1");
$result_team->execute(array($lastPart));
$num_team = $result_team->rowCount();

if ($num_team < 1) {
  header('Location: /painel/team');
}
?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Equipa > <span id="nameTeamH1"></span> </h1>
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
        <a href="#">Detalhes</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#" id="nameTeamA"></a>
      </li>
    </ul>
  </div>
</div>

<!-- MODAL -->
<div id="teamEditModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar equipa</h2>
    </div>


    <form class="modalForm" id="teamEditForm">
      <input id="id_edit_team" name="idTeam" hidden>

      <span id="msgEditTeamAlerta"></span>

      <div class="input-block">
        <div class="row">
          <div>
            <label for="name_team">Nome da Equipa</label>
            <input name="name_team" id="name_team" type="text" class="form-control" placeholder="Nome da Equipa">
          </div>

          <div>
            <label for="amount_members">Número de Integrantes:</label>
            <div class="select-input">
              <span></span>
              <select name="amount_members" class="form-control" id="amount_members">
                <option value="3">3 Membros</option>
                <option value="4">4 Membros</option>
                <option value="5">5 Membros</option>
                <!-- Adicione mais opções conforme necessário -->
              </select>
            </div>
          </div>

          <div>
            <label for="value_payment_team">Valor de Pagamento</label>
            <input id="value_payment_team" value="50.000,00Akz" disabled type="text" class="form-control" placeholder="Nome da Equipa">
          </div>

          <div>
            <label for="status_payment_team">Status:</label>
            <div class="select-input">
              <span></span>
              <select name="status_payment_team" class="form-control" id="status_payment_team">
                <option value="Pendente">Pendente</option>
                <option value="Pago">Pago</option>
              </select>
            </div>
          </div>

          <div id="buttonContainer">
            <button type="submit" style="width: 30%;" class="base-btn" id="nextButton">Salvar alterações</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>

<div id="memberEditModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do participante</h2>
    </div>

    <form id="memberEditForm" class="modalForm">
      <input id="id_edit" name="idMember" hidden>
      <span id="msgEditMemberAlerta"></span>

      <div class="row">
        <div class="col-md-12 p-sm-0">
          <div class="form-group">
            <label for="name_integrante_team">Nome do integrante da equipa</label>
            <input name="name_member" id="name_integrante_team_edit" type="text" class="form-control" placeholder="Nome do integrante da equipa" required>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="identity_card_integrante_team">Bilhete de Identidade</label>
              <input name="identity_card_member" id="identity_card_integrante_team_edit" type="text" class="form-control" placeholder="Bilhete de Identidade" required>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="nif_integrante_team">NIF</label>
              <input name="nif_member" id="nif_integrante_team_edit" type="text" class="form-control" placeholder="NIF" required>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-2 p-sm-0">
            <div class="form-group">
              <label for="age_integrante_team">Idade</label>
              <input name="age_member" id="age_integrante_team_edit" type="text" class="form-control" placeholder="Idade" required>
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="telephone_integrante_team">Telefone</label>
              <input name="telephone_member" id="telephone_integrante_team_edit" type="text" class="form-control" placeholder="Telefone" required>
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="household_integrante_team">Morada</label>
              <input name="household_member" id="household_integrante_team_edit" type="text" class="form-control" placeholder="Morada" required>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="email_integrante_team">Email</label>
              <input name="email_member" id="email_integrante_team_edit" type="text" class="form-control" placeholder="Email" required>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="selectProvince">Província </label>
              <div class="select-input">
                <span></span>
                <select name="province_member" id="selectProvince" type="text" class="form-control">
                  <option value="">Selecione a Província</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="selectCounty">Município </label>
              <div class="select-input">
                <span></span>
                <select name="county_member" id="selectCounty" type="text" class="form-control">
                  <option value="">Selecione o Município</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="selectUniversity">Universidade/Instituto </label>
              <div class="select-input">
                <span></span>
                <select name="university_member" id="selectUniversity" type="text" class="form-control">
                  <option value="">Escolhe uma opção</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="selectFaculty">Faculdade/Escola </label>
              <div class="select-input">
                <span></span>
                <select name="school_member" id="selectFaculty" type="text" class="form-control">
                  <option value="">Selecione a Universidade</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="selectCourse">Curso </label>
              <div class="select-input">
                <span></span>
                <select name="course_member" id="selectCourse" type="text" class="form-control">
                  <option value="">Selecione a Faculdade</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="selecYearAttend">Ano de Frequência </label>
              <div class="select-input">
                <span></span>
                <select name="year_attend_member" id="selecYearAttend" type="text" class="form-control">
                  <option value="">Selecione o Ano de Frequência</option>
                  <option value="2º Ano">2º Ano</option>
                  <option value="3º Ano">3º Ano</option>
                  <option value="4º Ano">4º Ano</option>
                  <option value="5º Ano">5º Ano</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="company_integrante_team">Nome da Empresa </label>
              <input name="company_member" id="company_integrante_team" type="text" class="form-control" placeholder="Nome da Empresa">
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="function_integrante_team">Função </label>
              <input name="function_member" id="function_integrante_team" type="text" class="form-control" placeholder="Função">
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="skills_integrante_team">Habilitações Literárias
              </label>
              <input name="skills_member" id="skills_integrante_team" type="text" class="form-control" placeholder="Habilitações Literárias">
            </div>
          </div>
        </div>
      </div>

      <div id="buttonContainer">
        <button type="submit" style="width: 30%;" class="base-btn">Salvar alterações</button>
      </div>
    </form>
  </div>
</div>

<div id="memberSeeModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Visualizar dados do participante</h2>
    </div>

    <form id="seeForm" class="modalForm">
      <div class="row">
        <div class="col-md-12 p-sm-0">
          <div class="form-group">
            <label for="name_integrante_team">Nome do integrante da equipa</label>
            <input name="name_member" id="name_integrante_team_see" type="text" class="form-control" disabled placeholder="Nome do integrante da equipa">
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="identity_card_integrante_team">Bilhete de Identidade</label>
              <input name="identity_card_member" id="identity_card_integrante_team_see" type="text" class="form-control" disabled placeholder="Bilhete de Identidade">
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="nif_integrante_team">NIF</label>
              <input name="nif_member" id="nif_integrante_team_see" type="text" class="form-control" placeholder="NIF" disabled>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-2 p-sm-0">
            <div class="form-group">
              <label for="age_integrante_team">Idade</label>
              <input name="age_member" id="age_integrante_team_see" type="text" class="form-control" placeholder="Idade" disabled>
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="telephone_integrante_team">Telefone</label>
              <input name="telephone_member" id="telephone_integrante_team_see" type="text" class="form-control" disabled placeholder="Telefone">
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="household_integrante_team">Morada</label>
              <input name="household_member" id="household_integrante_team_see" type="text" class="form-control" disabled placeholder="Morada">
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="email_integrante_team">Email</label>
              <input name="email_member" id="email_integrante_team_see" type="text" class="form-control" disabled placeholder="Email">
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="province_integrante_team">Província</label>
              <div class="select-input">
                <span></span>
                <input name="province_integrante" id="province_integrante_team_see" type="text" class="form-control" disabled>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="county_integrante_team">Município</label>
              <div class="select-input">
                <span></span>
                <input name="county_member" id="county_integrante_team_see" type="text" class="form-control" disabled>
              </div>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="university_integrante_team">Universidade/Instituto</label>
              <div class="select-input">
                <span></span>
                <input name="university_member" id="university_integrante_team_see" type="text" class="form-control" disabled>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="school_integrante_team">Faculdade/Escola</label>
              <div class="select-input">
                <span></span>
                <input name="school_member" id="school_integrante_team_see" type="text" class="form-control" disabled>
              </div>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="course_integrante_team">Curso</label>
              <div class="select-input">
                <span></span>
                <input name="course_member" id="course_integrante_team_see" type="text" class="form-control" disabled>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="year_attend_integrante_team">Ano de Frequência</label>
              <div class="select-input">
                <span></span>
                <input name="year_attend_member" id="year_attend_integrante_team_see" type="text" class="form-control" disabled>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 p-sm-0">
          <div class="form-group">
            <label for="company_member_team_see">Nome da Empresa</label>
            <input name="company_member_see" id="company_member_team_see" type="text" class="form-control" placeholder="Nome da Empresa" disabled>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="function_member_team_see">Função</label>
              <input name="function_member_see" id="function_member_team_see" type="text" class="form-control" placeholder="Função" disabled>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="skills_member_team_see">Habilitações Literárias</label>
              <input name="skills_member_see" id="skills_member_team_see" type="text" class="form-control" placeholder="Habilitações Literárias" disabled>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Dados da equipa</h3>
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
        <tr>
          <td>
            <p id="id_team_list"></p>
          </td>
          <td>
            <p id="name_team_list"></p>
          </td>
          <td>
            <p id="type_team_list"></p>
          </td>
          <td>
            <p id="amount_members_list"></p>
          </td>
          <td>
            <p id="value_payment_team_list"></p>
          </td>
          <td><span id="status_payment_team_list" class="status "></span></td>
          <td>
            <button class="btn-delete" onclick='deleteTeam()'>
              <i class="fas fa-trash-alt"></i>
            </button>
            <button class="btn-edit" onclick='editTeam()'>
              <i class="fas fa-edit"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Membros da equipa</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome do Membro</th>
          <th>Idade</th>
          <th>E-mail</th>
          <th>Telefone</th>
          <th>Bilhete</th>
          <th>Província</th>
          <th>Morada</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody id="tbodyMember">
      </tbody>
    </table>
  </div>
</div>

<div>
  <script src="<?= DASHBOARD_ACTIONS . "/actions_member.js" ?>"></script>
  <script src="<?= BASE_JS . "/jquery-3.6.0.min.js" ?>"></script>
  <script src="<?= BASE_JS . "/bootstrap2.min.js" ?>"></script>

  <script>
    $(document).ready(function() {
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

      const selectProvincia = $('#selectProvince');
      const selectCidade = $('#selectCounty');

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

      const listUniversity = async () => {
        await fetch(
            dashboardURL + 'facultyControllers.php?typeForm=get_all_university'
          )
          .then(response => response.json())
          .then(data => {
            // Itera sobre os dados retornados e adiciona opções ao select
            data.forEach(row => {
              const option = $('<option>').text(row.name_university).val(row.name_university);
              $('#selectUniversity').append(option)
            })
          })
          .catch(error => console.error('Erro:', error))
      }
      listUniversity()

      // >>>>>> CHANGE UNIVERSITY <<<<<<<
      $('#selectUniversity').change(function(e) {

        $('#selectCourse').empty()
        const newCourseOption = $('<option>').text('Selecione a Faculdade');
        $('#selectCourse').append(newCourseOption)

        const selectUniversityName = e.target.value

        // listFaculty
        const listFaculty = async () => {
          $('#selectFaculty').empty()

          const newOption = $('<option>').text('Selecione a Faculdade');
          $('#selectFaculty').append(newOption)

          await fetch(
              dashboardURL + 'facultyControllers.php?typeForm=get_all_data_faculty&nameUniversity=' +
              selectUniversityName
            )
            .then(response => response.json())
            .then(faculty => {
              // Itera sobre os dados retornados e adiciona opções ao select
              faculty.forEach(row => {
                const option = $('<option>').text(row.name_faculty).val(row.name_faculty);
                $('#selectFaculty').append(option)
              })
            })
            .catch(error => console.error('Erro:', error))
        }
        listFaculty()
      })

      // >>>>>> CHANGE UNIVERSITY <<<<<<<
      $('#selectFaculty').change(function(e) {

        const selectFacultyName = e.target.value

        // listCourse
        const listCourse = async () => {
          $('#selectCourse').empty()

          const newOption = $('<option>').text('Selecione o Curso');
          $('#selectCourse').append(newOption)

          await fetch(
              dashboardURL + 'courseControllers.php?typeForm=get_all_data_course&nameFaculty=' +
              selectFacultyName
            )
            .then(response => response.json())
            .then(course => {
              // Itera sobre os dados retornados e adiciona opções ao select
              course.forEach(row => {
                const option = $('<option>').text(row.name_course).val(row.name_course);
                $('#selectCourse').append(option)
              })
            })
            .catch(error => console.error('Erro:', error))
        }
        listCourse()
      })
    });
  </script>
</div>