<?php
try {
  $dsn = 'mysql:dbname=gs_db;host=localhost;charset=utf8;unix_socket=/tmp/mysql.sock';
  $user = 'root';
  $password = 'root';
  $pdo = new PDO($dsn,$user,$password);
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}
?>