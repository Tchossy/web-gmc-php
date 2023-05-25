<?php

include_once "../db/config.php";

$type_action = $_GET['typeAction'];

if ($type_action == 'count_utentes') {
  $query_get_utentes = "SELECT * FROM utentes";
  $result_utentes = $pdo->prepare($query_get_utentes);
  $result_utentes->execute();

  $num_utentes = $result_utentes->rowCount();

  echo $num_utentes;
}
if ($type_action == 'count_scheduling') {
  $query_get_scheduling = "SELECT * FROM scheduling";
  $result_scheduling = $pdo->prepare($query_get_scheduling);
  $result_scheduling->execute();

  $num_scheduling = $result_scheduling->rowCount();

  echo $num_scheduling;
}
if ($type_action == 'count_state_document') {
  $query_get_state_document = "SELECT * FROM state_document";
  $result_state_document = $pdo->prepare($query_get_state_document);
  $result_state_document->execute();

  $num_state_document = $result_state_document->rowCount();

  echo $num_state_document;
}

if ($type_action == 'get_utentes') {

  $result_utentes = $pdo->prepare("SELECT * FROM utentes ORDER BY id DESC LIMIT 8");
  $result_utentes->execute();
  $num_utentes = $result_utentes->rowCount();

  if ($num_utentes <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum utente cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_utentes = $result_utentes->fetch(PDO::FETCH_ASSOC)) {
      extract($row_utentes);

      $return .= "
                  <tr>
                    <td>
                      <p>$full_name_user</p>
                    </td>
                    <td>
                      <p>$email_address_user</p>
                    </td>
                    <td>$date_create_user</td>
                  </tr>
      ";
    }

    echo $return;
  }
}

if ($type_action == 'get_messages') {

  $result_messages = $pdo->prepare("SELECT * FROM messages_contact ORDER BY id DESC LIMIT 4");
  $result_messages->execute();
  $num_messages = $result_messages->rowCount();

  if ($num_messages <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum mensagem no momento </div>";
  } else {
    $return = "";

    while ($row_messages = $result_messages->fetch(PDO::FETCH_ASSOC)) {
      extract($row_messages);

      $return .= "
                  <li class='completed'>
                    <p><i>$email_user</i> <br/> <strong>$summary</strong> <br/> $message <br/> $date_create </p> 
                    <i class='bx bx-dots-vertical-rounded'></i>
                  </li>
      ";
    }

    echo $return;
  }
}
