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
