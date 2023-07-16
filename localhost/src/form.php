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

<script>
   
    function sendEmailOnCheck() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'checkMail.php');
        xhr.responseType = 'json';
        xhr.onload = () => {
            if (xhr.status !== 200) {
                return;
            }
            const response = xhr.response;
            if (response.output === 'уже используется') {
                document.querySelector('.send-button').style.display = 'none';
            } else {
                document.querySelector('.send-button').style.display = 'inline';
            }
        }

        // Получаем значение поля телефон
        let phoneInput = document.querySelector('.phone');
        let phoneValue = phoneInput.value;

        // Проверяем соответствие значения регулярному выражению
        let phoneRegex = /^[+]?[0-9]{6,}$/;
        let isValidPhone = phoneRegex.test(phoneValue);

        // Если значение не соответствует регулярному выражению, то выводим сообщение об ошибке
        if (!isValidPhone) {
            phoneInput.setCustomValidity('Телефон должен содержать минимум 6 символов от 0 до 9 и доступен "+" первым символом');
        } else {
            phoneInput.setCustomValidity('');
        }

        let formData = new FormData(document.forms.data);
        xhr.send(formData);
    }


    function emailOnSend() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'sendMail.php');
        xhr.responseType = 'json';
        xhr.onload = () => {
            if (xhr.status !== 200) {
            return;
            }
            const response = xhr.response;
            if (response.output === 'отправлено') {
            alert('Сообщение отправлено!');
            } else if (response.output === 'ошибка') {
            alert('Ошибка отправки сообщения!');
            }
        };
        let formData = new FormData(document.forms.data);
        xhr.send(formData);
    }
        
    document.forms.data.addEventListener('input', (e) => {
            e.preventDefault();
            sendEmailOnCheck();
    });

    document.forms.data.addEventListener('submit', (e) => {
        e.preventDefault();
        emailOnSend();
    });

  


</script>

</body>
</html>