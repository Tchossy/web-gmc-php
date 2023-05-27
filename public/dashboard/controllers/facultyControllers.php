<?php
include_once "../../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_faculty') {
  $num_register = $_GET['numRegister'];

  $result_faculty = $pdo->prepare("SELECT * FROM faculty ORDER BY id DESC LIMIT :limitRegister");
  $result_faculty->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_faculty->execute();
  $num_faculty = $result_faculty->rowCount();

  if ($num_faculty <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhuma faculdade cadastrada </div>";
  } else {
    $return = "";

    while ($row_faculty = $result_faculty->fetch(PDO::FETCH_ASSOC)) {

      extract($row_faculty);

      $return .= "
                  <tr>
                    <td>
                      <p>$id</p>
                    </td>
                    <td>
                      <p>$ref_faculty</p>
                    </td>
                    <td>
                      <p>$name_faculty</p>
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
if ($type_form == 'get_all_faculty_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM faculty WHERE name_faculty LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_faculty = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_faculty);

        $dataRegister .= "
                  <tr>
                    <td>
                      <p>$id</p>
                    </td>
                    <td>
                      <p>$ref_faculty</p>
                    </td>
                    <td>
                      <p>$name_faculty</p>
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

      $return = ['error' => false, 'msg' => $dataRegister];
    }
  }

  echo json_encode($return);
}

if ($type_form == 'get_all_data_faculty') {
  $name_university = $_GET['nameUniversity'];

  $result_faculty = $pdo->prepare("SELECT * FROM faculty WHERE name_university=?");
  $result_faculty->execute(array($name_university));
  $row_faculty = $result_faculty->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($row_faculty);
}

if ($type_form == 'get_all_university') {
  $result_university = $pdo->prepare("SELECT * FROM university");
  $result_university->execute();
  $row_university = $result_university->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($row_university);
}

if ($type_form == 'create_faculty') {
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

  $ref_faculty_form = $dataForm['ref_faculty'];
  $name_faculty_form = $dataForm['name_faculty'];
  $name_university_form = $dataForm['name_university'];
  $date_create_form = $completeDate;

  $result_faculty = $pdo->prepare("SELECT * FROM faculty WHERE name_faculty = ? ORDER BY id ");
  $result_faculty->execute(array($ref_faculty_form));
  $num_faculty = $result_faculty->rowCount();

  if ($num_faculty >= 1) {
    $return = ['error' => false, 'msg' =>  "<div class='alert alert-danger' role='alert' id='msgAlerta'> Está Universidade já encontra-se cadastrada </div>"];
  } else {
    if (empty($name_faculty_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nome da faculdade está vazio </div>"];
    } elseif (empty($ref_faculty_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo referencia da faculdade  está vazio </div>"];
    } elseif (empty($name_university_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não foi selecionada nenhuma universidade </div>"];
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

        $sql = $pdo->prepare("INSERT INTO faculty values(null,?,?,?,?,?)");

        if ($sql->execute(array(
          $ref_faculty_form,
          $ref_university_form,
          $name_faculty_form,
          $name_university_form,
          $date_create_form
        ))) {
          $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Universidade cadastrada com sucesso </div>"];
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar faculdade </div>"];
        };
      }
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_faculty') {
  $id_faculty = $_GET['idFaculty'];

  $result_faculty = $pdo->prepare("SELECT * FROM faculty WHERE id = ? ORDER BY id LIMIT 1");
  $result_faculty->execute(array($id_faculty));
  $num_faculty = $result_faculty->rowCount();

  if ($num_faculty >= 1) {
    $row_faculty = $result_faculty->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_faculty];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum faculdade com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'delete_faculty') {
  $id_faculty = $_GET['idFaculty'];

  $result_faculty = $pdo->prepare("DELETE FROM faculty WHERE id=?");

  if ($result_faculty->execute(array($id_faculty))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir a faculdade"];
  } else {
    $return = ['error' => true, 'msg' =>  "A faculdade não foi excluído :)"];
  }
}

if ($type_form == 'edite_faculty') {
  $id_faculty = $dataForm['idFaculty'];
  $name_faculty_form = $dataForm['name_faculty'];
  $ref_faculty_form = $dataForm['ref_faculty'];
  $name_university_form = $dataForm['name_university'];

  $return = "";

  if (empty($name_faculty_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome da faculdade está vazio </div>"];
  } elseif (empty($ref_faculty_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo faculdade está vazio </div>"];
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

      $sql = $pdo->prepare("UPDATE faculty SET name_faculty=?, ref_faculty=?, ref_university=?, name_university=? WHERE id=? ");

      if ($sql->execute(array(
        $name_faculty_form,
        $ref_faculty_form,
        $ref_university_form,
        $name_university_form,
        $id_faculty
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados da faculdade actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados da faculdade </div>"];
      };
    }
  }
  echo json_encode($return);
}
