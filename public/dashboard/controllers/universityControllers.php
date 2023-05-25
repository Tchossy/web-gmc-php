<?php
include_once "../../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_university') {

  $result_university = $pdo->prepare("SELECT * FROM university ORDER BY id DESC ");
  $result_university->execute();
  $num_university = $result_university->rowCount();

  if ($num_university <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhuma universidade cadastrada </div>";
  } else {
    $return = "";

    while ($row_university = $result_university->fetch(PDO::FETCH_ASSOC)) {

      extract($row_university);

      $return .= "
                  <tr>
                    <td>
                      <p>$id</p>
                    </td>
                    <td>
                      <p>$ref_university</p>
                    </td>
                    <td>
                      <p>$name_university</p>
                    </td>
                    <td>
                      <button onclick='deleteUniversity($id)' class='btn-delete'>
                        <i class='fas fa-trash-alt'></i>
                      </button>
                      <button onclick='editeUniversity($id)' class='btn-edit'>
                        <i class='fas fa-edit'></i>
                      </button>
                      <button onclick='seeUniversity($id)' class='btn-see'>
                        <i class='fas fa-eye'></i>
                      </button>
                    </td>
                  </tr>
                ";
    }

    echo $return;
  }
}

if ($type_form == 'create_university') {
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

  $ref_university_form = $dataForm['ref_university'];
  $name_university_form = $dataForm['name_university'];
  $date_create_form = $completeDate;

  $result_university = $pdo->prepare("SELECT * FROM university WHERE name_university = ? ORDER BY id ");
  $result_university->execute(array($ref_university_form));
  $num_university = $result_university->rowCount();

  if ($num_university >= 1) {
    $return = ['error' => false, 'msg' =>  "<div class='alert alert-danger' role='alert' id='msgAlerta'> Está Universidade já encontra-se cadastrada </div>"];
  } else {
    if (empty($name_university_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nome da universidade está vazio </div>"];
    } elseif (empty($ref_university_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo referencia da universidade  está vazio </div>"];
    } else {

      $sql = $pdo->prepare("INSERT INTO university values(null,?,?,?)");

      if ($sql->execute(array(
        $ref_university_form,
        $name_university_form,
        $date_create_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Universidade cadastrada com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar universidade </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_university') {
  $id_university = $_GET['idUniversity'];

  $result_university = $pdo->prepare("SELECT * FROM university WHERE id = ? ORDER BY id LIMIT 1");
  $result_university->execute(array($id_university));
  $num_university = $result_university->rowCount();

  if ($num_university >= 1) {
    $row_university = $result_university->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_university];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum universidade com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'delete_university') {
  $id_university = $_GET['idUniversity'];

  $result_university = $pdo->prepare("DELETE FROM university WHERE id=?");

  if ($result_university->execute(array($id_university))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir a universidade"];
  } else {
    $return = ['error' => true, 'msg' =>  "A universidade não foi excluído :)"];
  }
}

if ($type_form == 'edite_university') {
  $id_university = $dataForm['id_university'];
  $name_university_form = $dataForm['name_university'];
  $ref_university_form = $dataForm['ref_university'];

  $return = "";

  if (empty($name_university_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
  } elseif (empty($ref_university_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
  } else {
    $sql = $pdo->prepare("UPDATE university SET name_university=?, ref_university=? WHERE id=? ");

    if ($sql->execute(array(
      $name_university_form,
      $ref_university_form,
      $id_university
    ))) {
      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do universidade actualizados com sucesso </div>"];
    } else {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do universidade </div>"];
    };
  }
  echo json_encode($return);
}