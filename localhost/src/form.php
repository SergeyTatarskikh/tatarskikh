<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Тестовое задание</title>
</head>
<body>
    <div class="container">

    <form name = "data" action="sendMail.php" method="post" autocomplete="off" >
        <h1>Напишите нам</h1>
        <div class="data_block">
            <input type="text" class="name" placeholder="Имя" name="name" required>
            <input type="tel" class="phone" placeholder="Телефон" name="phone" required>
            <input type="email" class="email" placeholder="E-mail" name="email" id="email">
        </div>

        <div class="text_area">
            <p class="message">Сообщение</p>
            <textarea rows="5" placeholder="Напишите своё сообщение" name="message" required></textarea>
        </div>

        <div class="send">
            <button class="send-button">Отправить</button>
        </div>
    </form>
    </div>

    <script src="/js/script.js"></script>
</body>
</html>