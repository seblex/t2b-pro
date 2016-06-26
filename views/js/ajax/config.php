<?php
defined("CATALOG") or die("ACCESS DENIED!");
/* 
 * Файл конфигурации приложения
 * Содержит параметры подключения к БД
 * Переключение шаблона видов производится с помощью константы VIEW
 * Автор: Алексей Буров
 * Дата: 19.04.2016
 */

define("DBHOST", "");
define("DBUSER", "");
define("DBPASS", "");
define("DB", "");
define("PATH", "http://t2b-pro.ru/");
define("VIEW", "views/");
//define("PRODUCTIMG", "views/matsuri/img/products/");
//define("PERPAGE", 6);
//$option_perpage = array(6, 12, 18);


$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die('нет соединения с БД');
mysqli_set_charset($connection, "utf8") or die ('Не установлена кодировка соединения');

