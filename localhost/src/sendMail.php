<?php
require_once 'db.php';
// require_once 'checkMail.php';

//считываем данные формы
$name = htmlspecialchars(trim($_POST['name']));
$phone = htmlspecialchars(trim($_POST['phone']));
$email = htmlspecialchars(trim($_POST['email'])); 
$message = htmlspecialchars(trim($_POST['message']));

//проверяем наличие email в базе

$isExisting = $conn->query("SELECT * FROM `test` WHERE `email` = '$email'") -> fetch_assoc();
    if(!empty($isExisting)){
        $output = ['email' => 'ошибка'];
        exit(json_encode($output));
    }

//добавляем данные из формы в базу
$conn -> query("INSERT INTO test (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')" );
$conn->close();

//формируем сообщения для отправки на почту
$to = "sergey.tatarskikh2@gmail.com"; 
$subject = "Отправка сообщения из формы обратной связи"; 
$headers = "From: $email\r\n"; 
$headers .= "Content-type: text/plain; charset=UTF-8\r\n"; 
$sendMessage = "Имя: $name \nТелефон: $phone\nE-mail: $email\nСообщение: $message"; 

//отправка на почту
$send = mail($to, $subject, $sendMessage, $headers); 

if ($send){ 
    $output = ['output' => 'отправлено'];
    exit(json_encode($output));
} 
else { 
    $output = ['output' => 'ошибка'];
    exit(json_encode($output));
} 



