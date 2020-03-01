<?php
if(!emty($_POST['organization']) AND !emty($_POST['count']) AND !emty($_POST['name']) AND !emty($_POST['tel']) AND !emty($_POST['adress'])) {
  $letter = 'Данные сообщения:\r\n';
  $letter .= 'Организация: '.$_POST['organization']. '\r\n';
  $letter .= 'Количество: '.$_POST['count']. '\r\n';
  $letter .= 'Имя: '.$_POST['name']. '\r\n';
  $letter .= 'Телефон: '.$_POST['tel']. '\r\n';
  $letter .= 'Аресс: '.$_POST['adress']. '\r\n';
  $letter .= 'Сообщение: '.$_POST['massage']. '\r\n';
  mail('krivov_94@list.ru', 'Новое сообщение', $letter);
} else {
  header('/index.html');
};