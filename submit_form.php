<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $agree = isset($_POST['agree']) ? 'Yes' : 'No';
    $option = $_POST['option'];
    $file = $_FILES['file'];

    // Сохраняем данные в базу данных
    require 'database.php';

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message, agree, option, file_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $message, $agree, $option, $file['name']]);

    // Отправляем письмо администратору

    $to = 'PRIpara2006@yandex.ru';
    $subject = 'Тема письма';
    $message = 'Содержимое письма';
    $headers = 'From: your-email@example.com' . "\r\n";
    $from = trim($email);
 
    mail($to, $subject, $message, $headers);
}
echo "Форма успешно отправлена!";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Успешно</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <a href="/results.php">Посмотреть результат</a>
</body>
