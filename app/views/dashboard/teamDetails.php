<?php $this->layout("_theme");

include_once "config.php";

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
    <h1>Equipa > Tchossy Solution</h1>
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
        <a href="#">Tchossy Solution</a>
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
            <input id="value_payment_team" value="50.000,00Akz" disabled type="text" class="form-control"
              placeholder="Nome da Equipa">
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
      <h2>Visualizar dados do participante</h2>
    </div>

    <form id="memberEditForm" class="modalForm">
      <div class="row">
        <div class="col-md-12 p-sm-0">
          <div class="form-group">
            <label for="name_integrante_team">Nome do integrante da equipa</label>
            <input name="name_member" id="name_integrante_team_edit" type="text" class="form-control"
              placeholder="Nome do integrante da equipa">
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="identity_card_integrante_team">Bilhete de Identidade</label>
              <input name="identity_card_member" id="identity_card_integrante_team_edit" type="text"
                class="form-control" placeholder="Bilhete de Identidade">
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="nif_integrante_team">NIF</label>
              <input name="nif_member" id="nif_integrante_team_edit" type="text" class="form-control" placeholder="NIF">
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-2 p-sm-0">
            <div class="form-group">
              <label for="age_integrante_team">Idade</label>
              <input name="age_member" id="age_integrante_team_edit" type="text" class="form-control"
                placeholder="Idade">
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="telephone_integrante_team">Telefone</label>
              <input name="telephone_member" id="telephone_integrante_team_edit" type="text" class="form-control"
                placeholder="Telefone">
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="household_integrante_team">Morada</label>
              <input name="household_member" id="household_integrante_team_edit" type="text" class="form-control"
                placeholder="Morada">
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="email_integrante_team">Email</label>
              <input name="email_member" id="email_integrante_team_edit" type="text" class="form-control"
                placeholder="Email">
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="province_integrante_team">Província</label>
              <div class="select-input">
                <span></span>
                <select name="province_member" id="province_integrante_team_edit" type="text"
                  class="form-control required" required="">
                  <option value="Selecione">Selecione o Província</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="county_integrante_team">Município</label>
              <div class="select-input">
                <span></span>
                <select name="county_member" id="county_integrante_team_edit" type="text" class="form-control required"
                  required="">
                  <option value="Selecione">Selecione o Município</option>
                </select>
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
                <select name="university_member" id="university_integrante_team_edit" type="text"
                  class="form-control required" required="">
                  <option value="Escolhe">Escolhe uma opção</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="school_integrante_team">Faculdade/Escola</label>
              <div class="select-input">
                <span></span>
                <select name="school_member" id="school_integrante_team_edit" type="text" class="form-control required"
                  required="">
                  <option value="Selecione">Selecione a Universidade</option>
                </select>
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
                <select name="course_member" id="course_integrante_team_edit" type="text" class="form-control required"
                  required="">
                  <option value="Selecione">Selecione a Faculdade</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="year_attend_integrante_team">Ano de Frequência</label>
              <div class="select-input">
                <span></span>
                <select name="year_attend_member" id="year_attend_integrante_team_edit" type="text"
                  class="form-control required" required="">
                  <option value="2º Ano">2º Ano</option>
                  <option value="3º Ano">3º Ano</option>
                  <option value="4º Ano">4º Ano</option>
                  <option value="5º Ano">5º Ano</option>
                </select>
              </div>
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
            <input name="name_member" id="name_integrante_team_see" type="text" class="form-control" disabled
              placeholder="Nome do integrante da equipa">
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="identity_card_integrante_team">Bilhete de Identidade</label>
              <input name="identity_card_member" id="identity_card_integrante_team_see" type="text" class="form-control"
                disabled placeholder="Bilhete de Identidade">
            </div>
          </div>
          <div class="col-md-6 p-sm-0">
            <div class="form-group">
              <label for="nif_integrante_team">NIF</label>
              <input name="nif_member" id="nif_integrante_team_see" type="text" class="form-control" placeholder="NIF"
                disabled>
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-2 p-sm-0">
            <div class="form-group">
              <label for="age_integrante_team">Idade</label>
              <input name="age_member" id="age_integrante_team_see" type="text" class="form-control" placeholder="Idade"
                disabled>
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="telephone_integrante_team">Telefone</label>
              <input name="telephone_member" id="telephone_integrante_team_see" type="text" class="form-control"
                disabled placeholder="Telefone">
            </div>
          </div>
          <div class="col-md-5 p-sm-0">
            <div class="form-group">
              <label for="household_integrante_team">Morada</label>
              <input name="household_member" id="household_integrante_team_see" type="text" class="form-control"
                disabled placeholder="Morada">
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-12 p-sm-0">
            <div class="form-group">
              <label for="email_integrante_team">Email</label>
              <input name="email_member" id="email_integrante_team_see" type="text" class="form-control" disabled
                placeholder="Email">
            </div>
          </div>
        </div>

        <div class="rowItems">
          <div class="col-md-6 p-sm-0">
            <div class="form-group ">
              <label for="province_integrante_team">Província</label>
              <div class="select-input">
                <span></span>
                <input name="province_integrante" id="province_integrante_team_see" type="text" class="form-control"
                  disabled>
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
                <input name="university_member" id="university_integrante_team_see" type="text" class="form-control"
                  disabled>
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
                <input name="year_attend_member" id="year_attend_integrante_team_see" type="text" class="form-control"
                  disabled>
              </div>
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
</div>