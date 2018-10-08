<?php

$data = $_POST;

switch ($data['type']) {
  case 'get_all':
    GetAllUsers();
    break;
  case 'get_by_email':
    GetProfileByEmail($data['email']);
    break;
  case 'email_exists':
    EmailExists($data['email']);
    break;
  default:
    // code...
    break;
}

function GetAllUsers() {
  /*UPDATE WITH YOUR DATABASE INFORMATION*/
  $host = "127.0.0.1";
  $user = "root";
  $password = "";
  $table = "user_registration";
  /* END */

  $link = new mysqli($host, $user, $password, $table);

  if ($link->connect_errno) {
      echo "'get' Connect Failure: (".$link->connect_errno.")".$link->connect_error;
  }

  if(!$link->query(
    "create TABLE IF not exists users(
      user_id int not null auto_increment,
      first_name varchar(15) not null,
      last_name varchar(15) not null,
      email varchar(64) not null,
      age tinyint not null,
      PRIMARY KEY (user_id));")){
    echo false;
  }else {
    $result = $link->query("SELECT * FROM users");
    $result->data_seek(0);

    $users = [];

    while($row = $result->fetch_assoc()) {
      array_unshift($users, $row);
    }

    echo json_encode($users);
  }
}

/* FUNCTIONS */
function GetProfileByEmail($email) {
  /*UPDATE WITH YOUR DATABASE INFORMATION*/
  $host = "127.0.0.1";
  $user = "root";
  $password = "";
  $table = "user_registration";
  /* END */

  $link = mysqli_connect($host, $user, $password, $table);
  /* check connection */
  if (!$link) {
      printf("Error Connection:", mysqli_connect_error());
      exit();
  }

  $query = "SELECT * FROM users WHERE email='". $email."';";
  $result = mysqli_query($link, $query);
  $result->data_seek(0);

  $users = $result->fetch_object();

  echo json_encode($users);
  mysqli_free_result($result);
  mysqli_close($link);
}

function EmailExists($email){
  /*UPDATE WITH YOUR DATABASE INFORMATION*/
  $host = "127.0.0.1";
  $user = "root";
  $password = "";
  $table = "user_registration";
  /* END */

  $link = new mysqli($host, $user, $password, $table);

  if ($link->connect_errno) {
      echo "'get' Connect Failure: (".$link->connect_errno.")".$link->connect_error;
  }

  $result = $link->query("select * from users WHERE email = " . $email);
  if ($link->connect_errno) {
      echo "Failure: (".$link->connect_errno.")".$link->connect_error;
  }
  echo $result;

  if(!$result){
    return false;
  }else {
    return true;
  }
}
?>
