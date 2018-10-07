<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$table = "user_registration";

$link = new mysqli($host, $user, $pass, $table);
if ($link->connect_errno) {
    echo "Falha: (".$link->connect_errno.")".$link->connect_error;
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

  while($row = $result->fetch_assoc()){
    array_unshift($users, $row);
  }

  echo json_encode($users);
}
?>
