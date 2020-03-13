document.addEventListener('DOMContentLoaded', function () {

  initSendButton();

  function initSendButton() {
    let sendButton = document.querySelector('.form.container button');
    sendButton.addEventListener('click', function (e) {
      e.preventDefault();
      sendData();
    });
  }


  /**
   * Отправка данных
   */
  function sendData() {
    let formInputs = Array.from(
      document.querySelectorAll('.form.container input')
    ), data = [];

    formInputs.forEach(function (input) {
      if (input.getAttribute('type') !== 'checkbox') {
        data[input.name] = input.value
      }
    });

    ajaxPost('/submit.php', data);

    document.querySelector('.form.container').innerHTML = 'Сообщение успешно отправлено';
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
