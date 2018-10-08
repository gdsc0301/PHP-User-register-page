<?php
$data = $_POST;

/*UPDATE WITH YOUR DATABASE INFORMATION*/
$host = "127.0.0.1";
$user = "root";
$password = "";
$table = "user_registration";
/* END */

$link = new mysqli($host, $user, $password, $table);

switch ($data['type']) {
  case 'first_name':
    UpdateFirstName($data['data'], $data['id']);
    break;
  case 'last_name':
    UpdateLastName($data['data'], $data['id']);
    break;
  case 'email':
    UpdateEmail($data['data'], $data['id']);
    break;
  case 'age':
    UpdateAge($data['data'], $data['id']);
    break;
  case 'delete':
    DeleteUser($data['id']);
    break;
  default:
    return false;
    break;
}

function UpdateFirstName($first_name, $id){
  global $link;

  if ($link->connect_errno) {
      echo "Failure: (".$link->connect_errno.")".$link->connect_error;
  }

  if(!$link->query("UPDATE users SET first_name = '".$first_name."' WHERE user_id='".$id."'")){
    echo "Failure: (".$link->errno.")".$link->error;
  }else{
    $result = $link->query("select * FROM users WHERE user_id='".$id."';");
    $newData = $result->fetch_object();
    echo json_encode($newData);
  }
}

function UpdateLastName($last_name, $id){
  global $link;

  if ($link->connect_errno) {
      echo "Failure: (".$link->connect_errno.")".$link->connect_error;
  }

  if(!$link->query("UPDATE users SET last_name = '".$last_name."' WHERE user_id='".$id."'")){
    echo "Failure: (".$link->errno.")".$link->error;
  }else{
    $result = $link->query("select * FROM users WHERE user_id='".$id."';");
    $newData = $result->fetch_object();
    echo json_encode($newData);
  }
}

function UpdateEmail($email, $id){
  global $link;

  if ($link->connect_errno) {
      echo "Failure: (".$link->connect_errno.")".$link->connect_error;
  }

  if(!$link->query("UPDATE users SET email = '".$email."' WHERE user_id='".$id."'")){
    echo "Failure: (".$link->errno.")".$link->error;
  }else{
    $result = $link->query("select * FROM users WHERE user_id='".$id."';");
    $newData = $result->fetch_object();
    echo json_encode($newData);
  }
}

function UpdateAge($age, $id){
  global $link;
  if ($link->connect_errno) {
      echo "Failure: (".$link->connect_errno.")".$link->connect_error;
  }

  if(!$link->query("UPDATE users SET age = '".$age."' WHERE user_id='".$id."'")){
    echo "Failure: (".$link->errno.")".$link->error;
  }else{
    $result = $link->query("SELECT * FROM users WHERE user_id='".$id."';");
    $newData = $result->fetch_object();
    echo json_encode($newData);
  }
}

function DeleteUser($id){
  global $link;
  if ($link->connect_errno) {
      echo "Failure: (".$link->connect_errno.")".$link->connect_error;
  }
  if(!$link->query("DELETE FROM users WHERE user_id='".$id."';")) {
    echo "Failure: (".$link->errno.")".$link->error;
  }else{
    echo $id;
  }
}

 ?>
