<?php
include_once "../../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_course') {
  $num_register = $_GET['numRegister'];

  $result_course = $pdo->prepare("SELECT * FROM course ORDER BY id DESC LIMIT :limitRegister");
  $result_course->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_course->execute();
  $num_course = $result_course->rowCount();

  if ($num_course <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum curso cadastrada </div>";
  } else {
    $return = "";


    while ($row_course = $result_course->fetch(PDO::FETCH_ASSOC)) {

      extract($row_course);

      $result_faculty = $pdo->prepare("SELECT * FROM faculty WHERE name_faculty = ? ORDER BY id LIMIT 1");
      $result_faculty->execute(array($name_faculty));

      $name_university_form;

      while ($row_faculty = $result_faculty->fetch(PDO::FETCH_ASSOC)) {

        $name_university_form = $row_faculty['name_university'];
      }

      $return .= "
                  <tr>
                    <td>
                      <p>$id</p>
                    </td>
                    <td>
                      <p>$ref_course</p>
                    </td>
                    <td>
                      <p>$name_course</p>
                    </td>
                    <td>
                      <p>$name_faculty</p>
                    </td>
                    <td>
                      <p>$name_university_form</p>
                    </td>
                    <td>
                      <button onclick='deleteCourse($id)' class='btn-delete'>
                        <i class='fas fa-trash-alt'></i>
                      </button>
                      <button onclick='editeCourse($id)' class='btn-edit'>
                        <i class='fas fa-edit'></i>
                      </button>
                      <button onclick='seeCourse($id)' class='btn-see'>
                        <i class='fas fa-eye'></i>
                      </button>
                    </td>
                  </tr>
                ";
    }

    echo $return;
  }
}
if ($type_form == 'get_all_course_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM course WHERE name_course LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_course = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_course);

        $result_faculty = $pdo->prepare("SELECT * FROM faculty WHERE name_faculty = ? ORDER BY id LIMIT 1");
        $result_faculty->execute(array($name_faculty));

        $name_university_form;

        while ($row_faculty = $result_faculty->fetch(PDO::FETCH_ASSOC)) {

          $name_university_form = $row_faculty['name_university'];
        }

        $dataRegister .= "
                    <tr>
                      <td>
                        <p>$id</p>
                      </td>
                      <td>
                        <p>$ref_course</p>
                      </td>
                      <td>
                        <p>$name_course</p>
                      </td>
                      <td>
                        <p>$name_faculty</p>
                      </td>
                      <td>
                        <p>$name_university_form</p>
                      </td>
                      <td>
                        <button onclick='deleteCourse($id)' class='btn-delete'>
                          <i class='fas fa-trash-alt'></i>
                        </button>
                        <button onclick='editeCourse($id)' class='btn-edit'>
                          <i class='fas fa-edit'></i>
                        </button>
                        <button onclick='seeCourse($id)' class='btn-see'>
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

if ($type_form == 'get_all_faculty') {
  $result_faculty = $pdo->prepare("SELECT * FROM faculty");
  $result_faculty->execute();
  $row_faculty = $result_faculty->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($row_faculty);
}
if ($type_form == 'get_all_data_course') {
  $name_faculty = $_GET['nameFaculty'];

  $result_course = $pdo->prepare("SELECT * FROM course WHERE name_faculty=?");
  $result_course->execute(array($name_faculty));
  $row_course = $result_course->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($row_course);
}


if ($type_form == 'create_course') {
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

  $ref_course_form = $dataForm['ref_course'];
  $name_course_form = $dataForm['name_course'];
  $name_faculty_form = $dataForm['name_faculty'];
  $date_create_form = $completeDate;

  $result_course = $pdo->prepare("SELECT * FROM course WHERE name_course = ? ORDER BY id ");
  $result_course->execute(array($ref_course_form));
  $num_course = $result_course->rowCount();

  if ($num_course >= 1) {
    $return = ['error' => false, 'msg' =>  "<div class='alert alert-danger' role='alert' id='msgAlerta'> Está Universidade já encontra-se cadastrada </div>"];
  } else {
    if (empty($name_course_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nome d curso está vazio </div>"];
    } elseif (empty($ref_course_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo referencia d curso  está vazio </div>"];
    } elseif (empty($name_faculty_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não foi selecionada nenhuma universidade </div>"];
    } else {

      $result_faculty = $pdo->prepare("SELECT * FROM faculty WHERE name_faculty = ? ORDER BY id LIMIT 1");
      $result_faculty->execute(array($name_faculty_form));
      $num_faculty = $result_faculty->rowCount();

      if ($num_faculty <= 0) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> A universidade $name_faculty_form selecionada não está cadastra</div>"];
      } else {
        $ref_faculty_form;

        while ($row_faculty = $result_faculty->fetch(PDO::FETCH_ASSOC)) {
          extract($row_faculty);

          $ref_faculty_form = $ref_faculty;
        }

        $sql = $pdo->prepare("INSERT INTO course values(null,?,?,?,?,?)");

        if ($sql->execute(array(
          $ref_course_form,
          $ref_faculty_form,
          $name_faculty_form,
          $name_course_form,
          $date_create_form
        ))) {
          $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Universidade cadastrada com sucesso </div>"];
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar curso </div>"];
        };
      }
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_course') {
  $id_course = $_GET['idCourse'];

  $result_course = $pdo->prepare("SELECT * FROM course WHERE id = ? ORDER BY id LIMIT 1");
  $result_course->execute(array($id_course));
  $num_course = $result_course->rowCount();

  if ($num_course >= 1) {
    $row_course = $result_course->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_course];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum curso com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'delete_course') {
  $id_course = $_GET['idCourse'];

  $result_course = $pdo->prepare("DELETE FROM course WHERE id=?");

  if ($result_course->execute(array($id_course))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o curso"];
  } else {
    $return = ['error' => true, 'msg' =>  "A curso não foi excluído :)"];
  }
}

if ($type_form == 'edite_course') {
  $id_course = $dataForm['idCourse'];
  $name_course_form = $dataForm['name_course'];
  $ref_course_form = $dataForm['ref_course'];
  $name_faculty_form = $dataForm['name_faculty'];

  $return = "";

  if (empty($name_course_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome do curso está vazio </div>"];
  } elseif (empty($ref_course_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo curso está vazio </div>"];
  } elseif (empty($name_faculty_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Não foi selecionada a universidade </div>"];
  } else {
    $result_faculty = $pdo->prepare("SELECT * FROM faculty WHERE name_faculty = ? ORDER BY id LIMIT 1");
    $result_faculty->execute(array($name_faculty_form));
    $num_faculty = $result_faculty->rowCount();

    if ($num_faculty <= 0) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> A universidade $name_faculty_form selecionada não está cadastra</div>"];
    } else {
      $ref_faculty_form;

      while ($row_faculty = $result_faculty->fetch(PDO::FETCH_ASSOC)) {
        extract($row_faculty);

        $ref_faculty_form = $ref_faculty;
      }

      $sql = $pdo->prepare("UPDATE course SET name_course=?, ref_course=?, ref_faculty=?, name_faculty=? WHERE id=? ");

      if ($sql->execute(array(
        $name_course_form,
        $ref_course_form,
        $ref_faculty_form,
        $name_faculty_form,
        $id_course
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do curso actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do curso </div>"];
      };
    }
  }
  echo json_encode($return);
}
