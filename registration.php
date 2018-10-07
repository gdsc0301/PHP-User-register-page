<?php
  $user_data = $_POST;

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
      PRIMARY KEY (user_id));") ||

     !$link->query(
     "insert into users (first_name, last_name, email, age)
     values (
       '".$user_data['first_name']."',
       '".$user_data['last_name']."',
       '".$user_data['email']."',
       ".$user_data['age'].");")) {
        echo "Falha: (".$link->errno.")".$link->error;
  } else{
    echo json_encode($user_data);
  }
?>
