<?php

ini_set('display_errors', 'Off');


/**
 * Начало сессии
 */
session_start();

/**
 * Подключение файла, содержащего классы с различными методами, которые используются в 
 * данном приложении
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/app/init.php';

/**
 * Создание экземпляра класса App
 * @var object
 */
$app = new App;