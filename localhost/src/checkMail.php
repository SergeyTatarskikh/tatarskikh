<?php 
require_once 'db.php';

if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['phone'])) {
  // получим POST данные
  $email = $_POST['email'];

  //проверим на присутствие значения в базе
  $isExisting = $conn->query("SELECT * FROM test WHERE email = '$email'") -> fetch_assoc();
  if (!empty($isExisting)){
    $output = ['output' => 'уже используется'];
    exit(json_encode($output));
  }

  // сформируем ответ
  $output = ['output' => $email];
  exit(json_encode($output));
}
else {
  exit;
}