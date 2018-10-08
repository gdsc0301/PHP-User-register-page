<?php
  include 'get_profiles.php';

  $user_data = $_POST;

  /*UPDATE WITH YOUR DATABASE INFORMATION*/
  $host = "127.0.0.1";
  $user = "root";
  $password = "";
  $table = "user_registration";
  /* END */

  $link = new mysqli($host, $user, $password, $table);

  if ($link->connect_errno) {
      echo "Connect Failure: (".$link->connect_errno.")".$link->connect_error;
  }

  if(EmailExists($user_data['email'])){
    return 403;
    exit;
  }

  if(!$link->query(
    "CREATE TABLE IF not exists users(
      user_id int not null auto_increment,
      first_name varchar(15) not null,
      last_name varchar(15) not null,
      email varchar(64) not null unique,
      age tinyint not null,
      PRIMARY KEY (user_id),
      CONSTRAINT unique_emails UNIQUE (email));") ||

     !$link->query(
     "insert into users (first_name, last_name, email, age)
     values (
       '".$user_data['first_name']."',
       '".$user_data['last_name'] ."',
       '".$user_data['email']     ."',
       ".$user_data['age']        .");")) {
        echo "Query Failure: (".$link->errno.")".$link->error;
  }
?>
