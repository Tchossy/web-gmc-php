<?php
include_once "../../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_team') {

  $result_team = $pdo->prepare("SELECT * FROM team ORDER BY id DESC ");
  $result_team->execute();
  $num_team = $result_team->rowCount();

  if ($num_team <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhuma equipa cadastrada </div>";
  } else {
    $return = "";

    while ($row_team = $result_team->fetch(PDO::FETCH_ASSOC)) {

      extract($row_team);

      $return .= "
                  <tr>
                    <td>
                      <p>$id</p>
                    </td>
                    <td>
                      <p>$ref_team</p>
                    </td>
                    <td>
                      <p>$name_team</p>
                    </td>
                    <td>
                      <p>$name_university</p>
                    </td>
                    <td>
                      <button onclick='deleteFaculty($id)' class='btn-delete'>
                        <i class='fas fa-trash-alt'></i>
                      </button>
                      <button onclick='editeFaculty($id)' class='btn-edit'>
                        <i class='fas fa-edit'></i>
                      </button>
                      <button onclick='seeFaculty($id)' class='btn-see'>
                        <i class='fas fa-eye'></i>
                      </button>
                    </td>
                  </tr>
                ";
    }

    echo $return;
  }
}

if ($type_form == 'create_team') {
  $data = date('D');
  $mes = date('M');
  $dia = date('d');
  $ano = date('Y');

  $semana = array(
    'Sun' => 'Domingo',
    'Mon' => 'Segunda-Feira',
    'Tue' => 'Terca-Feira',
    'Wed' => 'Quarta-Feira',
    'Thu' => 'Quinta-Feira',
    'Fri' => 'Sexta-Feira',
    'Sat' => 'Sábado'
  );

  $mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'Fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
  );

  $completeDate =  $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";

  $name_team_form = $dataForm['name_team'];
  $type_team_form = $dataForm['type_team'];
  $num_members_form = $dataForm['numMembers'];
  $status_payment_team_form = "Pendente";
  $value_payment_team_form = 50000;
  $date_create_form = $completeDate;

  $result_team = $pdo->prepare("SELECT * FROM team WHERE name_team = ? ORDER BY id ");
  $result_team->execute(array($name_team_form));
  $num_team = $result_team->rowCount();

  if ($num_team >= 1) {
    $return = ['error' => true, 'msg' => "Está Equipe já encontra-se cadastrada"];
  } else {
    if (empty($name_team_form)) {
      $return = ['error' => true, 'msg' => "Erro: O campo nome da equipa está vazio"];
    } elseif (empty($type_team_form)) {
      $return = ['error' => true, 'msg' => "Erro: O campo tipo de equipa  está vazio"];
    } elseif (empty($value_payment_team_form)) {
      $return = ['error' => true, 'msg' => "Erro: O campo valor de pagamento está vazio"];
    } else {

      $sql = $pdo->prepare("INSERT INTO team values(null,?,?,?,?,?,?)");

      if ($sql->execute(array(
        $name_team_form,
        $type_team_form,
        $num_members_form,
        $value_payment_team_form,
        $status_payment_team_form,
        $date_create_form,
      ))) {

        $teamId = $pdo->lastInsertId();

        // Insere os dados dos integrantes
        for ($i = 1; $i <= $num_members_form; $i++) {
          $name_member_form = $_POST["name_member_" . $i];
          $identity_card_member_form = $_POST["identity_card_member_" . $i];
          $nif_member_form = $_POST["nif_member_" . $i];
          $age_member_form = $_POST["age_member_" . $i];
          $telephone_member_form = $_POST["telephone_member_" . $i];
          $household_member_form = $_POST["household_member_" . $i];
          $email_member_form = $_POST["email_member_" . $i];
          $province_member_form = $_POST["province_member_" . $i];
          $county_member_form = $_POST["county_member_" . $i];
          $university_member_form = '-----------------';
          $school_member_form = '-----------------';
          $course_member_form = '-----------------';
          $year_attend_member_form = '-----------------';
          $company_member_form = '-----------------';
          $function_member_form = '-----------------';
          $skills_member_form = '-----------------';

          $sqlIntegrante = "INSERT INTO members (
            team_id,
            name_member,
            identity_card_member,
            nif_member,
            age_member,
            telephone_member,
            household_member,
            email_member,
            province_member,
            county_member,
            university_member,
            school_member,
            course_member,
            year_attend_member,
            company_member,
            function_member,
            skills_member,
            date_create
          ) VALUES (
            :team_id,
            :name_member,
            :identity_card_member,
            :nif_member,
            :age_member,
            :telephone_member,
            :household_member,
            :email_member,
            :province_member,
            :county_member,
            :university_member,
            :school_member,
            :course_member,
            :year_attend_member,
            :company_member,
            :function_member,
            :skills_member,
            :date_create
          )";

          $result_member = $pdo->prepare($sqlIntegrante);
          $result_member->bindParam(':team_id', $teamId);
          $result_member->bindParam(':name_member', $name_member_form);
          $result_member->bindParam(':identity_card_member', $identity_card_member_form);
          $result_member->bindParam(':nif_member', $nif_member_form);
          $result_member->bindParam(':age_member', $age_member_form);
          $result_member->bindParam(':telephone_member', $telephone_member_form);
          $result_member->bindParam(':household_member', $household_member_form);
          $result_member->bindParam(':email_member', $email_member_form);
          $result_member->bindParam(':province_member', $province_member_form);
          $result_member->bindParam(':county_member', $county_member_form);

          if (!empty($_POST["university_member_" . $i])) {
            $university_member_form = $_POST["university_member_" . $i];
          }
          $result_member->bindParam(':university_member', $university_member_form);

          if (!empty($_POST["school_member_" . $i])) {
            $school_member_form = $_POST["school_member_" . $i];
          }
          $result_member->bindParam(':school_member', $school_member_form);

          if (!empty($_POST["course_member_" . $i])) {
            $course_member_form = $_POST["course_member_" . $i];
          }
          $result_member->bindParam(':course_member', $course_member_form);

          if (!empty($_POST["year_attend_member_" . $i])) {
            $year_attend_member_form = $_POST["year_attend_member_" . $i];
          }
          $result_member->bindParam(':year_attend_member', $year_attend_member_form);

          if (!empty($_POST["year_attend_member_" . $i])) {
            $year_attend_member_form = $_POST["year_attend_member_" . $i];
          }
          $result_member->bindParam(':company_member', $company_member_form);

          if (!empty($_POST["company_member_" . $i])) {
            $company_member_form = $_POST["company_member_" . $i];
          }
          $result_member->bindParam(':function_member', $function_member_form);

          if (!empty($_POST["function_member_" . $i])) {
            $function_member_form = $_POST["function_member_" . $i];
          }
          $result_member->bindParam(':skills_member', $skills_member_form);

          if (!empty($_POST["skills_member_" . $i])) {
            $skills_member_form = $_POST["skills_member_" . $i];
          }

          $result_member->bindParam(':date_create', $date_create_form);
          $result_member->execute();
        }

        $return = ['error' => false, 'msg' =>  "Equipe cadastrada com sucesso"];
      } else {
        $return = ['error' => true, 'msg' => "Erro: Ouve um erro ao cadastrar equipa"];
      };
    }
  }

  echo json_encode($return);
}

if ($type_form == 'get_team') {
  $id_team = $_GET['idFaculty'];

  $result_team = $pdo->prepare("SELECT * FROM team WHERE id = ? ORDER BY id LIMIT 1");
  $result_team->execute(array($id_team));
  $num_team = $result_team->rowCount();

  if ($num_team >= 1) {
    $row_team = $result_team->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_team];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum equipa com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'delete_team') {
  $id_team = $_GET['idFaculty'];

  $result_team = $pdo->prepare("DELETE FROM team WHERE id=?");

  if ($result_team->execute(array($id_team))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir a equipa"];
  } else {
    $return = ['error' => true, 'msg' =>  "A equipa não foi excluído :)"];
  }
}

if ($type_form == 'edite_team') {
  $id_team = $dataForm['idFaculty'];
  $name_team_form = $dataForm['name_team'];
  $ref_team_form = $dataForm['ref_team'];
  $name_university_form = $dataForm['name_university'];

  $return = "";

  if (empty($name_team_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome da equipa está vazio </div>"];
  } elseif (empty($ref_team_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo equipa está vazio </div>"];
  } elseif (empty($name_university_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Não foi selecionada a universidade </div>"];
  } else {
    $result_university = $pdo->prepare("SELECT * FROM university WHERE name_university = ? ORDER BY id LIMIT 1");
    $result_university->execute(array($name_university_form));
    $num_university = $result_university->rowCount();

    if ($num_university <= 0) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> A universidade $name_university_form selecionada não está cadastra</div>"];
    } else {
      $ref_university_form;

      while ($row_university = $result_university->fetch(PDO::FETCH_ASSOC)) {
        extract($row_university);

        $ref_university_form = $ref_university;
      }

      $sql = $pdo->prepare("UPDATE team SET name_team=?, ref_team=?, ref_university=?, name_university=? WHERE id=? ");

      if ($sql->execute(array(
        $name_team_form,
        $ref_team_form,
        $ref_university_form,
        $name_university_form,
        $id_team
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados da equipa actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados da equipa </div>"];
      };
    }
  }
  echo json_encode($return);
}