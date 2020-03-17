document.addEventListener('DOMContentLoaded', function () {

  initSendButton('.form.container');
  initSendButton('.modal-block form');

  function initSendButton(selector) {
    let sendButton = document.querySelector(selector + ' input[type="submit"]');
    sendButton.addEventListener('click', function (e) {
      e.preventDefault();
      sendData(selector);
    });
  }


  /**
   * Отправка данных
   */
  function sendData(selector) {
    let formInputs = Array.from(
      document.querySelectorAll(selector + ' input')
    ), data = [];

    formInputs.forEach(function (input) {
      if (input.getAttribute('type') !== 'checkbox') {
        data[input.name] = input.value
      }
    });

    ajaxPost('/submit.php', data);

    if (selector == '.form.container') {
      document.querySelector(selector).innerHTML = 'Сообщение успешно отправленоefefefe';
    } else if (selector == '.modal-block form') {
      document.querySelector(selector).innerHTML = 'Сообщение успешно отправлено';
    }

    
  }


  /**
   * Типа ajax
   * @param url
   * @param data
   */
  function ajaxPost(url, data) {
    // создать объект для формы
    var formData = new FormData();

    for (var i in data) if (data.hasOwnProperty(i)) {
      // добавить к пересылке ещё пару ключ - значение
      formData.append(i.toString(), data[i].toString());
    }

    // отослать
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    xhr.send(formData);
  }
});
