<?php

  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME','library');

  $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
  }

  $query="CREATE DATABASE IF NOT EXISTS library";
  if (mysqli_query($con, $query));
  else {
    echo "Error creating database: " . mysqli_error($conn);
  }
  $link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $sql1 = "CREATE TABLE IF NOT EXISTS users (
      id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      username varchar(50) NOT NULL,
      password varchar(50) NOT NULL,
      email varchar(100) NOT NULL,
      created_at datetime DEFAULT current_timestamp(),
      UNIQUE KEY username (username)
    )";

  if (mysqli_query($link, $sql1));
  else {
    echo "Error creating table: " . mysqli_error($link);
  }

  $sql2="CREATE TABLE IF NOT EXISTS books (
    Book_id int(11) NOT NULL AUTO_INCREMENT,
    Title varchar(50) NOT NULL,
    Author varchar(50) NOT NULL,
    Category varchar(50) NOT NULL,
    Price int NOT NULL,
    Available varchar(1) DEFAULT 'y',
    Description text,
    Review float,
    PRIMARY KEY (book_id)
  )";

  if (mysqli_query($link, $sql2));
  else {
    echo "Error creating table: " . mysqli_error($link);
  }

  
?>