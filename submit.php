<?php
/**
* Подключение библиотеки
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $data = $_POST;

  /**
  * Обьявление полей
  */
  $fields = [
  'organization' => 'Организация', //лучше company
  'count' => 'Количество', // лучше amount
  'name' => 'Имя', // name - лучше firstname
  'tel' => 'Телефон', // общепринято phone
  'adress' => 'Адрес', // address пишется с двумя d
  'massage' => 'Сообщение' // правильно message
  ];

  /**
  * Проверка полей
  */
  // foreach ($fields as $field => $caption) {

  // if ( empty($data[$field]) ) {
  // echo 'Поле ' . $caption . ' не заполнено. Перенапраляем обратно';

  // header( "refresh:5;url=/index.html" );
  // }
  // }

  /**
  * Создание письма
  */
  $letter = 'Данные сообщения <br>';

  foreach ($fields as $field => $caption) {
  $value = $data[$field];
  $letter .= $caption . ': ' . $value . '<br>';
  }

  $mail = new PHPMailer(true);

  /**
  * PHPMailer библиотека для отправки писем, требуется логин и пароль от каких либо почтовиков
  * нужно создать свою учетную запись где нить, например на яндексе, и потом настроить отправку по этой инструкции
  * https://yandex.ru/support/mail/mail-clients.html
  *
  * вот еще одна инструкция
  * https://medium.com/@shpaginkirill/вменяемая-инструкци..
  */

  try {
  //Настройки сервера
  $mail->isSMTP();
  $mail->CharSet = 'UTF-8'; // Send using SMTP
  $mail->Host = 'smtp.yandex.ru'; // Установить SMTP сервер
  $mail->SMTPAuth = true;
  $mail->Username = 'UserWater@yandex.ru'; // Указать логин
  $mail->Password = 'useruser'; // Указать пароль
  $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
  $mail->Port = 465; // TCP port to connect to

  //Recipients
  $mail->setFrom('UserWater@yandex.ru', 'Mailer'); // указать от кого
  //$mail->addAddress('waterelmnt@gmail.com', 'Joe User'); // указать кому (кому заявки будут отправлятся)
  $mail->addAddress('krivov_94@list.ru', 'Joe User');
  // Контент
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = 'Новая заявка с сайта';
  $mail->Body = $letter;

  $mail->send();
  echo 'Сообщение успешно отправленено';
  header( "refresh:5;url=/index.html" );

  } catch (Exception $e) {

  echo "Сообщение не удалось отправить. Ошибка: {$mail->ErrorInfo}";
  header( "refresh:5;url=/index.html" );

  }
}